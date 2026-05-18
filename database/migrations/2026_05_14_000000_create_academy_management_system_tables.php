<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('owner_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('logo')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
        });

        Schema::create('campuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->string('name');
            $table->string('code');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->boolean('is_main')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['academy_id', 'code']);
            $table->index(['academy_id', 'status']);
            $table->index('manager_id');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->nullable()->constrained('academies')->nullOnDelete();
            $table->foreignId('campus_id')->nullable()->constrained('campuses')->nullOnDelete();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->enum('user_type', ['super_admin', 'admin', 'teacher', 'student', 'finance'])->default('student');
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['academy_id', 'campus_id']);
            $table->index(['user_type', 'status']);
            $table->index('phone');
        });

        Schema::table('campuses', function (Blueprint $table) {
            $table->foreign('manager_id')->references('id')->on('users')->nullOnDelete();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->nullable()->constrained('academies')->nullOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $this->auditColumns($table);

            $table->unique(['academy_id', 'slug']);
            $table->index('status');
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('module');
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['role_id', 'user_id']);
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained('permissions')->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_current')->default(false);
            $table->enum('status', ['active', 'closed'])->default('active');
            $this->auditColumns($table);

            $table->unique(['academy_id', 'name']);
            $table->index(['academy_id', 'is_current', 'status']);
        });

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->string('name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->enum('status', ['active', 'closed'])->default('active');
            $this->auditColumns($table);

            $table->unique(['academic_year_id', 'name']);
            $table->index(['academy_id', 'academic_year_id', 'status']);
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->nullable()->constrained('campuses')->nullOnDelete();
            $table->string('name');
            $table->string('code');
            $table->text('description')->nullable();
            $table->unsignedInteger('duration_years')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $this->auditColumns($table);

            $table->unique(['academy_id', 'campus_id', 'code']);
            $table->index(['academy_id', 'campus_id', 'status']);
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->string('name');
            $table->string('code');
            $table->decimal('credit', 5, 2)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $this->auditColumns($table);

            $table->unique(['program_id', 'code']);
            $table->index(['academy_id', 'program_id', 'status']);
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('teacher_code')->unique();
            $table->string('name');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('qualification')->nullable();
            $table->string('specialization')->nullable();
            $table->date('joining_date')->nullable();
            $table->enum('salary_type', ['fixed', 'per_class', 'per_session'])->default('fixed');
            $table->decimal('salary_amount', 12, 2)->nullable();
            $table->enum('status', ['active', 'inactive', 'resigned'])->default('active');
            $this->auditColumns($table);

            $table->index(['academy_id', 'campus_id', 'status']);
            $table->index(['academy_id', 'campus_id', 'teacher_code']);
            $table->index('phone');
            $table->index('email');
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('student_code')->unique();
            $table->string('name');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->date('admission_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'completed', 'dropped'])->default('active');
            $this->auditColumns($table);

            $table->index(['academy_id', 'campus_id', 'status']);
            $table->index(['academy_id', 'campus_id', 'student_code']);
            $table->index('phone');
            $table->index('email');
        });

        Schema::create('teacher_subject', function (Blueprint $table) {
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('campus_id')->nullable()->constrained('campuses')->nullOnDelete();
            $table->foreignId('academic_year_id')->nullable()->constrained('academic_years')->nullOnDelete();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->unique(['teacher_id', 'subject_id', 'campus_id', 'academic_year_id'], 'teacher_subject_unique_assignment');
            $table->index(['teacher_id', 'status']);
            $table->index(['subject_id', 'status']);
        });

        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->string('class_code');
            $table->string('name');
            $table->string('room_no')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('max_students')->nullable();
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $this->auditColumns($table);

            $table->unique(['academy_id', 'campus_id', 'class_code']);
            $table->index(['campus_id', 'program_id', 'subject_id', 'teacher_id'], 'class_rooms_main_lookup_index');
            $table->index(['academic_year_id', 'semester_id', 'status']);
        });

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->string('enrollment_no')->unique();
            $table->date('enrollment_date');
            $table->enum('status', ['active', 'completed', 'dropped', 'transferred'])->default('active');
            $this->auditColumns($table);

            $table->unique(['class_room_id', 'student_id'], 'enrollments_unique_student_class');
            $table->index(['student_id', 'class_room_id', 'academic_year_id', 'semester_id'], 'enrollments_main_lookup_index');
            $table->index(['academy_id', 'campus_id', 'status']);
        });

        Schema::create('session_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->foreignId('class_room_id')->nullable()->constrained('class_rooms')->nullOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->unsignedInteger('session_number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('objectives')->nullable();
            $table->text('teaching_methods')->nullable();
            $table->text('materials')->nullable();
            $table->date('planned_date')->nullable();
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->enum('status', ['draft', 'published', 'completed', 'cancelled'])->default('draft');
            $this->auditColumns($table);

            $table->unique([
                'academy_id',
                'campus_id',
                'subject_id',
                'academic_year_id',
                'semester_id',
                'teacher_id',
                'session_number',
            ], 'session_plans_unique_session');
            $table->index(['campus_id', 'program_id', 'subject_id', 'academic_year_id', 'semester_id', 'teacher_id'], 'session_plans_main_lookup_index');
            $table->index(['class_room_id', 'status']);
        });

        Schema::create('session_plan_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_plan_id')->constrained('session_plans')->cascadeOnDelete();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('file_type');
        });

        Schema::create('session_plan_bulk_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->unsignedInteger('number_of_sessions');
            $table->unsignedInteger('starting_session_number');
            $table->string('base_title')->nullable();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['academy_id', 'campus_id', 'subject_id', 'academic_year_id', 'semester_id'], 'session_plan_bulk_logs_lookup_index');
            $table->index('teacher_id');
        });

        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->foreignId('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('assigned_date');
            $table->date('due_date');
            $table->decimal('total_marks', 8, 2)->default(0);
            $table->string('attachment')->nullable();
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            $this->auditColumns($table);

            $table->index(['class_room_id', 'subject_id', 'teacher_id', 'due_date'], 'assignments_main_lookup_index');
            $table->index(['academic_year_id', 'semester_id', 'status']);
        });

        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained('assignments')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->dateTime('submitted_at')->nullable();
            $table->string('file_path')->nullable();
            $table->text('answer_text')->nullable();
            $table->decimal('marks', 8, 2)->nullable();
            $table->text('teacher_comment')->nullable();
            $table->enum('status', ['pending', 'submitted', 'reviewed', 'late'])->default('pending');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['assignment_id', 'student_id']);
            $table->index(['student_id', 'status']);
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->date('attendance_date');
            $table->foreignId('session_plan_id')->nullable()->constrained('session_plans')->nullOnDelete();
            $table->enum('status', ['draft', 'submitted', 'approved'])->default('draft');
            $table->text('note')->nullable();
            $table->foreignId('marked_by')->constrained('users')->cascadeOnDelete();
            $this->auditColumns($table);

            $table->unique(['class_room_id', 'subject_id', 'attendance_date'], 'attendances_unique_class_subject_date');
            $table->index(['class_room_id', 'teacher_id', 'attendance_date'], 'attendances_main_lookup_index');
            $table->index(['academic_year_id', 'semester_id', 'status']);
        });

        Schema::create('attendance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained('attendances')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->enum('status', ['present', 'absent', 'late', 'permission'])->default('present');
            $table->time('check_in_time')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->unique(['attendance_id', 'student_id']);
            $table->index(['student_id', 'status']);
        });

        Schema::create('score_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('weight_percentage', 5, 2)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $this->auditColumns($table);

            $table->unique(['academy_id', 'name']);
            $table->index('status');
        });

        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('class_room_id')->constrained('class_rooms')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('score_category_id')->constrained('score_categories')->cascadeOnDelete();
            $table->string('reference_type')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->decimal('score', 8, 2)->default(0);
            $table->decimal('max_score', 8, 2)->default(100);
            $table->string('grade')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $this->auditColumns($table);

            $table->index(['student_id', 'subject_id', 'class_room_id', 'semester_id'], 'scores_student_subject_lookup_index');
            $table->index(['teacher_id', 'score_category_id', 'status']);
            $table->index(['reference_type', 'reference_id']);
        });

        Schema::create('grade_scales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->string('grade');
            $table->decimal('min_score', 8, 2);
            $table->decimal('max_score', 8, 2);
            $table->string('remark')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $this->auditColumns($table);

            $table->unique(['academy_id', 'grade']);
            $table->index(['academy_id', 'min_score', 'max_score']);
        });

        Schema::create('teacher_payment_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->nullable()->constrained('campuses')->nullOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->nullOnDelete();
            $table->enum('rate_type', ['monthly', 'per_class', 'per_session', 'percentage'])->default('monthly');
            $table->decimal('rate_amount', 12, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $this->auditColumns($table);

            $table->index(['teacher_id', 'subject_id', 'status']);
            $table->index(['academy_id', 'campus_id']);
        });

        Schema::create('teacher_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->string('payment_no')->unique();
            $table->string('payment_month', 7)->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->unsignedInteger('total_sessions')->default(0);
            $table->unsignedInteger('total_classes')->default(0);
            $table->decimal('gross_amount', 12, 2)->default(0);
            $table->decimal('deduction', 12, 2)->default(0);
            $table->decimal('net_amount', 12, 2)->default(0);
            $table->enum('payment_method', ['cash', 'bank', 'aba', 'wing'])->nullable();
            $table->date('payment_date')->nullable();
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->text('note')->nullable();
            $this->auditColumns($table);

            $table->index(['teacher_id', 'payment_month', 'status']);
            $table->index(['academy_id', 'campus_id']);
        });

        Schema::create('teacher_payment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_payment_id')->constrained('teacher_payments')->cascadeOnDelete();
            $table->foreignId('class_room_id')->nullable()->constrained('class_rooms')->nullOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->nullOnDelete();
            $table->foreignId('session_plan_id')->nullable()->constrained('session_plans')->nullOnDelete();
            $table->string('description')->nullable();
            $table->decimal('qty', 10, 2)->default(1);
            $table->decimal('rate', 12, 2)->default(0);
            $table->decimal('amount', 12, 2)->default(0);
            $table->timestamps();

            $table->index(['class_room_id', 'subject_id', 'session_plan_id'], 'teacher_payment_items_lookup_index');
        });

        Schema::create('payout_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->nullable()->constrained('campuses')->nullOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->string('request_no')->unique();
            $table->decimal('amount', 12, 2)->default(0);
            $table->enum('payment_method', ['cash', 'bank', 'aba', 'wing'])->default('cash');
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->text('reason')->nullable();
            $table->dateTime('requested_at');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('approved_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
            $table->text('admin_note')->nullable();
            $this->auditColumns($table);

            $table->index(['teacher_id', 'status', 'requested_at']);
            $table->index(['academy_id', 'campus_id']);
        });

        Schema::create('fee_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $this->auditColumns($table);

            $table->unique(['academy_id', 'name']);
            $table->index('status');
        });

        Schema::create('student_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('campuses')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('enrollment_id')->nullable()->constrained('enrollments')->nullOnDelete();
            $table->string('invoice_no')->unique();
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('due_amount', 12, 2)->default(0);
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->enum('status', ['active', 'cancelled'])->default('active');
            $this->auditColumns($table);

            $table->index(['student_id', 'payment_status']);
            $table->index(['academy_id', 'campus_id', 'invoice_date']);
        });

        Schema::create('student_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_invoice_id')->constrained('student_invoices')->cascadeOnDelete();
            $table->foreignId('fee_category_id')->constrained('fee_categories')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->decimal('amount', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->timestamps();

            $table->index('fee_category_id');
        });

        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_invoice_id')->constrained('student_invoices')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->date('payment_date');
            $table->enum('method', ['cash', 'bank', 'aba', 'wing', 'card'])->default('cash');
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('reference_no')->nullable();
            $table->foreignId('received_by')->constrained('users')->cascadeOnDelete();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['student_id', 'payment_date']);
            $table->index(['method', 'reference_no']);
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('campus_id')->nullable()->constrained('campuses')->nullOnDelete();
            $table->string('title');
            $table->text('message');
            $table->enum('notification_type', ['system', 'email', 'sms', 'telegram'])->default('system');
            $table->enum('target_type', ['all', 'teacher', 'student', 'admin'])->default('all');
            $table->dateTime('send_at')->nullable();
            $table->enum('status', ['draft', 'sent', 'failed'])->default('draft');
            $this->auditColumns($table);

            $table->index(['academy_id', 'campus_id', 'status']);
            $table->index(['notification_type', 'target_type']);
        });

        Schema::create('notification_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained('notifications')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('read_at')->nullable();
            $table->enum('status', ['pending', 'sent', 'read', 'failed'])->default('pending');
            $table->timestamps();

            $table->unique(['notification_id', 'user_id']);
            $table->index(['user_id', 'status']);
        });

        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->constrained('academies')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('document_type');
            $table->string('file_path');
            $table->text('note')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $this->auditColumns($table);

            $table->index(['academy_id', 'user_id', 'document_type']);
        });

        Schema::create('profile_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->json('old_data')->nullable();
            $table->json('new_data');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('reviewed_at')->nullable();
            $this->auditColumns($table);

            $table->index(['user_id', 'status']);
            $table->index('reviewed_by');
        });

        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->nullable()->constrained('academies')->nullOnDelete();
            $table->foreignId('campus_id')->nullable()->constrained('campuses')->nullOnDelete();
            $table->string('setting_key');
            $table->text('setting_value')->nullable();
            $table->string('setting_type')->default('text');
            $table->string('group_name')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $this->auditColumns($table);

            $table->unique(['academy_id', 'campus_id', 'setting_key'], 'system_settings_unique_scope_key');
            $table->index(['group_name', 'status']);
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academy_id')->nullable()->constrained('academies')->nullOnDelete();
            $table->foreignId('campus_id')->nullable()->constrained('campuses')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('module');
            $table->string('action');
            $table->text('description');
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['academy_id', 'campus_id', 'user_id', 'module'], 'activity_logs_main_lookup_index');
            $table->index(['action', 'created_at']);
        });

        Schema::create('login_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('login_at');
            $table->dateTime('logout_at')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->enum('status', ['success', 'failed'])->default('success');
            $table->timestamps();

            $table->index(['user_id', 'login_at']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('login_histories');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('profile_updates');
        Schema::dropIfExists('user_documents');
        Schema::dropIfExists('notification_recipients');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('student_payments');
        Schema::dropIfExists('student_invoice_items');
        Schema::dropIfExists('student_invoices');
        Schema::dropIfExists('fee_categories');
        Schema::dropIfExists('payout_requests');
        Schema::dropIfExists('teacher_payment_items');
        Schema::dropIfExists('teacher_payments');
        Schema::dropIfExists('teacher_payment_rates');
        Schema::dropIfExists('grade_scales');
        Schema::dropIfExists('scores');
        Schema::dropIfExists('score_categories');
        Schema::dropIfExists('attendance_details');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('assignment_submissions');
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('session_plan_bulk_logs');
        Schema::dropIfExists('session_plan_attachments');
        Schema::dropIfExists('session_plans');
        Schema::dropIfExists('enrollments');
        Schema::dropIfExists('class_rooms');
        Schema::dropIfExists('teacher_subject');
        Schema::dropIfExists('students');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('academic_years');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('campuses');
        Schema::dropIfExists('academies');

        Schema::enableForeignKeyConstraints();
    }

    private function auditColumns(Blueprint $table, bool $withSoftDeletes = true): void
    {
        $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
        $table->timestamps();

        if ($withSoftDeletes) {
            $table->softDeletes();
        }
    }
};
