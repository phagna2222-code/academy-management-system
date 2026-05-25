---
name: livewire-modal-crud-testing
description: End-to-end testing pattern for the academy-management-system app's Livewire + Bootstrap 5 modal CRUD modules. Use when verifying a modal CRUD module's create/edit/delete flow or when auditing for nullable-validation vs NOT NULL schema mismatches.
---

# Testing Livewire + Bootstrap 5 modal CRUD

Use this skill when verifying any of the 13 admin CRUD modules (academies, campuses, users, roles, permissions, academic-years, semesters, programs, subjects, teachers, students, class-rooms, enrollments).

## Boot the app

```bash
# from repo root
composer install --no-progress --no-interaction
test -f .env || cp .env.example .env
php artisan key:generate --force --quiet
php artisan migrate:fresh --seed --force
php artisan serve --host=127.0.0.1 --port=8000
```

The `DatabaseSeeder` + `AcademyDemoSeeder` create a super-admin: **`admin@example.com` / `password`**. This account has every permission and bypasses all `ensurePermission()` checks.

## 6-step adversarial matrix per module

For each module's `/admin/<resource>` index page, walk these steps once. Each step must independently pass.

1. **Create-invalid**: Click `+ Create`, leave required fields blank, click Save. Pass = inline validation error (Livewire) or HTML5 browser-required popover; **never** a 500 page.
2. **Create-valid**: Fill required fields with valid data, click Save. Pass = modal closes, "Created successfully" toast appears top-right, new row appears in the DataTable via a single XHR (no full-page reload — check the bottom-right of the screenshot for the `GET /admin/<resource>/data` request).
3. **Edit-open**: Click the blue pencil icon on the new row. Pass = modal opens **in-place** (URL stays at `/admin/<resource>`), all fields pre-populated from the row.
4. **Edit-save**: Change one field, click Save. Pass = "Updated successfully" toast, row reflects new value.
5. **Delete-confirm**: Click the red trash icon on the row. Pass = SweetAlert2 confirm dialog ("Are you sure?").
6. **Delete-execute**: Click "Yes, delete it!". Pass = "Deleted successfully" toast, row is gone from the DataTable.

## Adversarial cases worth testing beyond the matrix

- **Permissions**: Create the same `module + name + blank slug` twice in a row. The second submit must produce an inline `unique` validation error, not a SQLite UNIQUE 500.
- **Users**: The trash button must be **hidden** on the currently-authenticated user's row (self-delete guard).
- **Users edit with blank password**: Open the edit modal, leave both password fields blank, save. The existing password should be preserved (the `nullable|min:6` rule short-circuits).
- **Any modal with FK selects**: Try submitting with required-looking selects left blank. If a 500 with `SQLSTATE[23000]: NOT NULL constraint failed: <table>.<column>` appears, you found a schema-vs-validation mismatch (see audit below).

## Audit: find `nullable` rules against `NOT NULL` FK columns

This class of bug bit the ClassRoom and Enrollment modals during the refactor. To check the rest of the codebase quickly:

```bash
# 1) List all nullable foreign-key rules in Livewire modals
rg -n "'(\w+_id)' => \['nullable'" app/Livewire/Admin/

# 2) For each match, check whether the same column is nullable in the migration
rg -n "foreignId\('semester_id'\)" database/migrations/
# A line ending with ->constrained(...)\->cascadeOnDelete() (no nullable()) means the column is NOT NULL,
# so the validation rule MUST be 'required' (and the blade select MUST have required + a * marker).
```

When you find a mismatch, the fix is two files:

- `app/Livewire/Admin/<Module>Modal.php` rules array: `nullable` -> `required`.
- `resources/views/livewire/admin/<module>-modal.blade.php` corresponding `<select>`:
  - add `required` to the `<select>` tag,
  - replace `<option value="">—</option>` with `<option value="">{{ __('app.common.choose') }}</option>`,
  - add `<span class="text-danger">*</span>` after the label text.

## Lint, test, and PR

```bash
./vendor/bin/pint --test    # lint
php artisan test            # unit/feature tests
```

Both must be green before pushing. CI runs CodeRabbit + Devin Review only (no GitHub Actions job).

## Cleanup between runs

The demo seeder is destructive — `php artisan migrate:fresh --seed --force` will drop and recreate the SQLite DB. Use it to reset state between adversarial test runs.
