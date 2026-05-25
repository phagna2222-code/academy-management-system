# 📖 Academy Management System — Training Manual

**ប្រព័ន្ធគ្រប់គ្រងសាលា | Academy Management System (AMS)**
Bilingual training manual — Khmer 🇰🇭 · English 🇬🇧
Version 1.0 · Based on `phagna2222-code/academy-management-system` after PR #1–#5

> ℹ️ **How to use this document — របៀបប្រើឯកសារនេះ**
> ឯកសារនេះត្រូវបានសរសេរសម្រាប់ Notion។ ភាសាខ្មែរនៅខាងលើ ភាសាអង់គ្លេសនៅខាងក្រោម។ រាល់មេរៀននីមួយៗ មាន Badge បង្ហាញកម្រិតអ្នកប្រើ។
> This document is designed for Notion. Khmer is on top, English below. Every lesson includes a Badge to indicate the audience level.

> 💡 **Import to Notion — នាំចូលទៅ Notion**
> បើកទំព័រ Notion ថ្មី → វាយ `/import` → ជ្រើស *Markdown & CSV* → ផ្ទុកឯកសារនេះ។ ផ្នែក toggle និង table នឹងបម្លែងស្វ័យប្រវត្តិ។
> Open a new Notion page → type `/import` → choose *Markdown & CSV* → upload this file. Toggles and tables convert automatically.

---

## 🎯 Audience Badges — ស្លាកកម្រិតអ្នកប្រើ

| Badge | Khmer | English | Color hint (Notion) |
| --- | --- | --- | --- |
| 🟢 **End-User** | អ្នកប្រើប្រាស់ប្រចាំថ្ងៃ | Daily user | `green_background` |
| 🟡 **Admin** | អ្នកគ្រប់គ្រងប្រព័ន្ធ | System admin / Power user | `yellow_background` |
| 🔵 **Manager** | អ្នកត្រួតពិនិត្យ និងរបាយការណ៍ | Oversight & reports | `blue_background` |

When you import to Notion, select each badge cell and set the background color to match.

---

# 📌 Cover & Overview — ការណែនាំទូទៅ

## 🎯 Purpose — គោលបំណង

| ខ្មែរ | English |
| --- | --- |
| Academy Management System (AMS) គឺជាប្រព័ន្ធបណ្តាញគ្រប់គ្រងសាលា សម្រាប់ផ្តល់ការគ្រប់គ្រងពេញលេញលើ សាខា, និស្សិត, គ្រូបង្រៀន, កម្មវិធីសិក្សា, និងការចុះឈ្មោះ។ | The Academy Management System (AMS) is a web-based platform that delivers end-to-end management of campuses, students, teachers, programs, and enrollments. |
| ប្រព័ន្ធនេះប្រើ Laravel 12, Livewire 4.3, និង Bootstrap 5.3 ដើម្បីផ្តល់នូវចំណុចប្រទាក់រហ័ស ងាយប្រើប្រាស់ដោយ modal-based CRUD។ | Built with Laravel 12, Livewire 4.3, and Bootstrap 5.3 to provide a snappy, modal-driven CRUD interface. |

## 👥 Target Users — អ្នកប្រើគោលដៅ

| Role | ខ្មែរ | English |
| --- | --- | --- |
| 🟡 Super Admin | អ្នកគ្រប់គ្រងផ្នែកលើ — សិទ្ធិពេញលេញលើគ្រប់សាលា | Top-level system administrator — full access across all academies |
| 🟡 Academy Admin | អ្នកគ្រប់គ្រងសាលា — សិទ្ធិពេញលេញលើសាលាមួយ | Administrator for a single academy |
| 🔵 Campus Manager | អ្នកគ្រប់គ្រងសាខា — បង្កើត/កែ គ្រូ, និស្សិត, ថ្នាក់, ការចុះឈ្មោះ | Manages teachers, students, classrooms, enrollments at a single campus |
| 🟢 Teacher | គ្រូបង្រៀន — មើលថ្នាក់រៀន មុខវិជ្ជា និស្សិត | Read-only on classes, subjects, students |
| 🟢 Student | និស្សិត — សិទ្ធិអប្បបរមា | Minimal access |

## ⭐ Key Features — លក្ខណៈពិសេសសំខាន់

> ✅ **What you can do — អ្វីដែលអ្នកអាចធ្វើបាន**
> - គ្រប់គ្រងសាលា និងសាខា (Academies & Campuses)
> - គ្រប់គ្រងឆ្នាំសិក្សា និងឆមាស (Academic Years & Semesters)
> - រៀបចំកម្មវិធីសិក្សា និងមុខវិជ្ជា (Programs & Subjects)
> - គ្រប់គ្រងគ្រូ និងនិស្សិត (Teachers & Students)
> - បង្កើតថ្នាក់រៀន និងការចុះឈ្មោះ (Class Rooms & Enrollments)
> - គ្រប់គ្រងអ្នកប្រើ តួនាទី និងសិទ្ធិ (Users, Roles, Permissions)
> - ដំណើរការ ខ្មែរ/អង់គ្លេស (Khmer / English locales)
> - ការគ្រប់គ្រងផ្អែកលើ Modal (Modal-based CRUD)

---

# 🗂️ Table of Contents — មាតិកា

> ℹ️ Notion will auto-generate a Table of Contents when you insert a `/toc` block at the top of the imported page. Below is a manual outline.

1. **Cover & Overview** — ការណែនាំទូទៅ
2. **Getting Started** — ការចាប់ផ្តើម
    1. System Requirements
    2. Account Setup / Login
    3. UI Tour & Navigation
3. **Module-by-Module Guide** — មេរៀនតាម Module
    1. Academies (សាលា)
    2. Campuses / Branches (សាខា)
    3. Academic Years (ឆ្នាំសិក្សា)
    4. Semesters (ឆមាស)
    5. Programs (កម្មវិធីសិក្សា)
    6. Subjects (មុខវិជ្ជា)
    7. Teachers (គ្រូបង្រៀន)
    8. Students (និស្សិត)
    9. Class Rooms (ថ្នាក់រៀន)
    10. Enrollments (ការចុះឈ្មោះ)
    11. Users (អ្នកប្រើ)
    12. Roles (តួនាទី)
    13. Permissions (សិទ្ធិ)
    14. Profile (ប្រវត្តិរូប)
4. **End-to-End Workflow Scenarios** — ករណីប្រើពិតជាក់ស្តែង
5. **Best Practices & Standards** — បទដ្ឋាន
6. **FAQ & Troubleshooting** — សំណួរញឹកញាប់
7. **Glossary** — វាក្យសព្ទ
8. **Final Checklist for Customers** — បញ្ជីត្រួតពិនិត្យ

---

# 🚀 Getting Started — ការចាប់ផ្តើម

## 🖥️ System Requirements — តម្រូវការប្រព័ន្ធ

| Item | ខ្មែរ | English |
| --- | --- | --- |
| Browser | Chrome, Edge, Firefox, Safari ជំនាន់ថ្មីៗ | Latest Chrome, Edge, Firefox, or Safari |
| Internet | តភ្ជាប់សុវត្ថិភាព (HTTPS) | Secure connection (HTTPS) |
| Resolution | យ៉ាងតិច 1280×720 | 1280×720 minimum |
| JavaScript | ត្រូវបើក | Must be enabled |
| Cookies | ត្រូវបើក (សម្រាប់ session និង locale) | Must be enabled (for session & locale) |

> ⚠️ **JavaScript & Cookies — ខាងបច្ចេកទេស**
> ប្រព័ន្ធ AMS ប្រើ Livewire ដែលត្រូវការ JavaScript និង AJAX។ បើបិទ JavaScript, modal CRUD នឹងមិនដំណើរការ។
> AMS uses Livewire which requires JavaScript and AJAX. With JavaScript disabled, modal CRUD will not work.

## 🔐 Account Setup / Login — ការចូលប្រើ

🟢 **End-User** · 🟡 **Admin** · 🔵 **Manager**

### Step-by-step — ជំហានមួយម្តងៗ

1. **បើក URL ប្រព័ន្ធ** / Open the system URL — `https://<your-domain>` (or `http://127.0.0.1:8000` for local).
2. ប្រព័ន្ធនឹងបង្ហាញទំព័រ Login ដោយស្វ័យប្រវត្តិ។ / The system redirects to the Login page automatically.
3. **បំពេញ Email** / Enter your email — e.g. `admin@example.com`
4. **បំពេញ Password** / Enter your password — e.g. `password` (demo only)
5. ចុច **Login** / Click **Login**.
6. ប្រសិនបើជោគជ័យ ប្រព័ន្ធនឹងបង្ហាញ Dashboard។ / On success, the Dashboard appears.

🖼️ *[Insert screenshot: Login page showing email & password fields, language dropdown, "Login" button]*

> 💡 **Tip — គន្លឹះ**
> Email field ត្រូវបាន pre-filled ដោយគណនី demo (`admin@example.com`) សម្រាប់ការសាកល្បង។
> The email field is pre-filled with the demo account (`admin@example.com`) for testing convenience.

> ⚠️ **Warning — ការប្រុងប្រយ័ត្ន**
> សូម**មិន**ប្រើ password `password` នៅក្នុង production។ ផ្លាស់ប្តូរ password ភ្លាមៗបន្ទាប់ពីការតំឡើងលើកដំបូង។
> Do **NOT** use `password` in production. Change it immediately after initial setup via *Profile → Change password*.

### Logout — ការចេញ

1. ចុចលើ **រូបអ្នកប្រើ** នៅជ្រុងស្តាំខាងលើ / Click your **avatar** at the top-right.
2. ជ្រើស **Logout** ពី dropdown / Choose **Logout** from the dropdown.
3. ប្រព័ន្ធបញ្ជូនអ្នកត្រលប់ទៅ `/login` ដោយ session ត្រូវលុបពេញលេញ។ / You are redirected back to `/login` and the session is fully cleared.

## 🧭 UI Tour & Navigation — ការប្រើប្រាស់ប្រព័ន្ធ

🖼️ *[Insert screenshot: Annotated dashboard with sidebar, top bar, breadcrumb, content area, debug bar]*

| Region | ខ្មែរ | English |
| --- | --- | --- |
| **Left Sidebar** | តំណភ្ជាប់ទៅគ្រប់ Module — បានបង្ហាញតែ Module ដែលអ្នកមានសិទ្ធិ | Links to every module — only modules you have permission for are shown |
| **Top Bar** | Breadcrumb, ស្វែងរក, ប្តូរភាសា, ឈ្មោះអ្នកប្រើ | Breadcrumb, search, language switcher, user dropdown |
| **Content Area** | តារាងទិន្នន័យ (DataTable) និងប៊ូតុង **Create** | DataTable + **Create** button |
| **Action Buttons** | ✏️ កែ (Edit) និង 🗑️ លុប (Delete) ក្នុងជួរ "Actions" | ✏️ Edit and 🗑️ Delete in the "Actions" column |
| **Modal Window** | ទម្រង់ Create/Edit ត្រូវបង្ហាញក្នុង modal — មិនបាច់ផ្ទុកទំព័រឡើងវិញ | Create/Edit forms appear in a modal — no full-page reload |

### Sidebar Group Map — តារាងក្រុមម៉ឺនុយ

| Group | Modules |
| --- | --- |
| 📊 **Dashboard** | Dashboard |
| 🏛️ **Academies** | Academies |
| 🏢 **Campuses / Branches** | Campuses |
| 📅 **Academic Calendar** | Academic Years · Semesters |
| 📚 **Curriculum** | Programs · Subjects |
| 👥 **People** | Teachers · Students |
| 🪑 **Classes** | Class Rooms · Enrollments |
| 🛡️ **Security** | Users · Roles · Permissions |

### Language Switcher — ការប្តូរភាសា

1. ចុចលើ **EN ▾** / **KM ▾** នៅជ្រុងស្តាំខាងលើ / Click the **EN ▾** / **KM ▾** badge at the top-right.
2. ជ្រើស **English** ឬ **Khmer** / Choose **English** or **Khmer**.
3. ទំព័រនឹងបង្ហាញឡើងវិញភ្លាមៗដោយប្រើភាសាថ្មី (ដោយមិនបាច់ផ្ទុកទំព័រឡើងវិញ)។ / The page re-renders instantly in the new language (no full reload).

🖼️ *[Insert screenshot: Language dropdown open showing English ✓ and Khmer options]*

> 💡 ភាសាដែលបានជ្រើស នឹងត្រូវរក្សាទុកក្នុង session និង cookie ដូច្នេះ visitors នឹងឃើញភាសាដដែលនៅពេលចូលប្រើពេលក្រោយ។ / Locale persists in session + cookie so subsequent visits use the same language.

---

# 📦 Module-by-Module Guide — មេរៀនតាម Module

> ℹ️ រាល់ Module មានរូបរាងដូចគ្នា — តារាង + Search + Pagination + **Create** + Action Buttons (Edit, Delete)។ ការផ្លាស់ប្តូរទាំងអស់កើតឡើងក្នុង Modal ដោយប្រើ Livewire + Bootstrap 5។
> Every module shares the same layout — table + Search + Pagination + **Create** + Action Buttons (Edit, Delete). All mutations happen in a Livewire-driven Bootstrap 5 modal.

> 💡 **Common shortcuts — ផ្លូវកាត់ទូទៅ**
> - ការ search ដំណើរការ live (server-side)
> - ការទាញ-ហើយតម្រៀបជួរ (drag-to-reorder) មិនបាន — តម្រៀបដោយចុចលើ column header
> - SweetAlert2 បង្ហាញការបញ្ជាក់សម្រាប់រាល់ការ Delete
> - DataTables refresh ស្វ័យប្រវត្តិបន្ទាប់ពី Create/Edit/Delete

---

## 1️⃣ Academies — សាលា

> 🟡 **Audience: Super Admin only**

### 🎯 Purpose — គោលបំណង
| ខ្មែរ | English |
| --- | --- |
| គ្រប់គ្រងព័ត៌មានសាលា (មួយឬច្រើនអង្គភាព) — ឈ្មោះ, លេខកូដ, ម្ចាស់, ទំនាក់ទំនង, និង logo។ | Manage one or more academy organisations — name, code, owner, contact info, and logo. |

### 📝 Step-by-step

#### Create — បង្កើតថ្មី
1. Sidebar → **Academies** → **+ Create** (top-right).
2. បំពេញព័ត៌មាន / Fill in:
    - **Name*** (តម្រូវ / required)
    - **Code*** (តម្រូវ, តែមួយគត់ / required, unique)
    - Owner name, phone, email, website, address (ស្រេចចិត្ត / optional)
    - Logo (ស្រេចចិត្ត / optional — URL or upload path)
    - **Status**: Active / Inactive
3. ចុច **Save** / Click **Save**.

🖼️ *[Insert screenshot: Academy modal with Name, Code, Owner, Email, Website fields]*

#### Edit — កែប្រែ
1. ស្វែងរកជួរក្នុង DataTable / Find the row in the DataTable.
2. ចុចលើ ✏️ ក្នុង column **Actions** / Click ✏️ in the **Actions** column.
3. Modal បើកឡើងជាមួយទិន្នន័យ pre-filled / Modal opens with data pre-filled.
4. ផ្លាស់ប្តូរ → **Save** / Modify → **Save**.

#### Delete — លុប
1. ចុចលើ 🗑️ ក្នុង column **Actions** / Click 🗑️ in the **Actions** column.
2. SweetAlert2 បង្ហាញ — **Confirm** / SweetAlert2 prompt — click **Confirm**.

### 💡 Tips & Best Practices
- ប្រើ **Code** ខ្លី (3–6 តួអក្សរ) — ឧ. `AMS-MAIN` / Use short **Code** (3–6 chars) — e.g. `AMS-MAIN`.
- បំពេញ contact info ពេញលេញ ដើម្បីបង្ហាញ branding ច្បាស់លាស់ / Fill complete contact info for clean branding.

### ⚠️ Warnings / Common Mistakes
- **Code** ដែលស្ទួនបញ្ឈប់ការ save ដោយមាន inline error / Duplicate **Code** is blocked with inline validation error.
- ការលុបសាលា **ប្រឆាំងនឹង soft-delete**, តែ FK ទៅ Campuses/Users/AcademicYears នឹង orphan if cascade is not configured — សូមផ្លាស់ប្តូរ status ទៅ Inactive ជំនួសវិញ / Deleting an academy **soft-deletes** the row, but related Campuses/Users will reference a missing parent if cascade is not configured — prefer setting status to *Inactive* instead.

### ✅ Mini Checklist
- [ ] Academy created with unique Code
- [ ] Owner contact filled
- [ ] At least one Campus linked

---

## 2️⃣ Campuses / Branches — សាខា

> 🟡 **Audience: Super Admin · Academy Admin**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| គ្រប់គ្រងសាខារបស់សាលា — ឈ្មោះ, លេខកូដ, អ្នកគ្រប់គ្រង, និងសាខាមេ។ | Manage academy branches — name, code, manager, and main-branch flag. |

### 📝 Step-by-step

#### Create
1. Sidebar → **Campuses / Branches** → **+ Create**.
2. បំពេញ / Fill in:
    - **Academy*** — ជ្រើសសាលា / select parent academy
    - **Name***
    - **Code***
    - Manager (ស្រេចចិត្ត — ត្រូវតែជា User ដែលមាន) / optional — must be an existing User
    - **Is Main** (បើ ✓ → សាខាមេតែមួយគត់ក្នុងសាលា) / if checked → only main branch per academy
3. **Save**.

🖼️ *[Insert screenshot: Campus modal with Academy dropdown, Name, Code, Manager Tom Select, Is Main checkbox]*

### 💡 Tips
- មាន **Is Main** តែមួយគត់ក្នុងសាលា / Only one **Is Main** campus per academy.
- ប្រើ **Manager** ដើម្បីផ្តល់សិទ្ធិ Campus Manager / Use **Manager** to assign the Campus Manager role.

### ⚠️ Warnings
- ប្រសិនបើ Manager ត្រូវ delete, Campus FK នឹង reference NULL — សូម reassign Manager មុនលុបអ្នកប្រើ។ / If you delete the Manager User, the Campus FK becomes NULL — reassign first.

### ✅ Mini Checklist
- [ ] Campus linked to an academy
- [ ] Is Main is set for exactly one campus
- [ ] Manager (optional) is a valid user

---

## 3️⃣ Academic Years — ឆ្នាំសិក្សា

> 🟡 **Audience: Super Admin · Academy Admin**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| កំណត់រយៈពេលរបស់ឆ្នាំសិក្សា — ឈ្មោះ, កាលបរិច្ឆេទចាប់ផ្តើម, ចប់, និងស្ថានភាព (បច្ចុប្បន្ន/បិទ)។ | Define academic year periods — name, start/end dates, current flag, status. |

### 📝 Step-by-step

#### Create
1. Sidebar → **Academic Calendar** → **Academic Years** → **+ Create**.
2. បំពេញ / Fill:
    - **Academy***
    - **Name*** — ឧ. `2026–2027`
    - **Start Date*** និង **End Date*** (End ≥ Start)
    - **Is Current** (✓ បើជាឆ្នាំសិក្សាដែលកំពុងដំណើរការ)
    - **Status**: Active / Closed
3. **Save**.

🖼️ *[Insert screenshot: Academic Year modal with date pickers and Is Current checkbox]*

### 💡 Tips
- **Is Current** គួរត្រូវកំណត់សម្រាប់ឆ្នាំសិក្សាមួយប៉ុណ្ណោះ / **Is Current** should be set on a single academic year at a time.
- ឆ្នាំសិក្សា Closed មិនអនុញ្ញាតឱ្យបង្កើត Enrollment ថ្មីឡើយ (រឹតបន្តឹងនៅកម្រិតប្រតិបត្តិការ) / Closed academic years should not accept new Enrollments (operational discipline).

### ⚠️ Warnings
- កុំកំណត់ Start Date **ក្រោយ** End Date — validation ហាមឃាត់។ / Don't set Start **after** End — validation prevents save.

### ✅ Mini Checklist
- [ ] Year linked to academy
- [ ] Start ≤ End
- [ ] Exactly one Is Current per academy

---

## 4️⃣ Semesters — ឆមាស

> 🟡 **Audience: Super Admin · Academy Admin**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| ឆមាសក្នុងឆ្នាំសិក្សា — ឧ. ឆមាសទី ១, ឆមាសទី ២, ឬ Term 1–3។ | Semesters within an academic year — e.g. Semester 1, Semester 2, or Terms 1–3. |

### 📝 Step-by-step

#### Create
1. Sidebar → **Academic Calendar** → **Semesters** → **+ Create**.
2. បំពេញ / Fill:
    - **Academy*** · **Academic Year***
    - **Name*** — e.g. `Semester 1`
    - Start / End dates (optional)
    - Sort Order — សម្រាប់រៀបជួរ / display order
    - **Status**: Active / Closed
3. **Save**.

🖼️ *[Insert screenshot: Semester modal showing Academy → AcademicYear cascade]*

### 💡 Tips
- ប្រើ **Sort Order** ដើម្បីរៀបឆមាសក្នុង dropdown / Use **Sort Order** to order semesters in dropdowns.

### ✅ Mini Checklist
- [ ] Semester linked to an Academic Year
- [ ] Sort Order numbered sequentially

---

## 5️⃣ Programs — កម្មវិធីសិក្សា

> 🟡 **Audience: Super Admin · Academy Admin**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| កម្មវិធីសិក្សា (e.g. English, Mathematics, Computer Science) ដែលផ្តល់ដោយសាលា។ | Programs of study (e.g. English, Mathematics, Computer Science) offered by the academy. |

### 📝 Step-by-step

#### Create
1. Sidebar → **Curriculum** → **Programs** → **+ Create**.
2. បំពេញ / Fill:
    - **Academy*** · Campus (optional — បើ blank, កម្មវិធីដែលអាចប្រើគ្រប់សាខា / leave blank → academy-wide)
    - **Name*** · **Code***
    - Description
    - Duration (years)
    - **Status**: Active / Inactive
3. **Save**.

🖼️ *[Insert screenshot: Program modal with Academy + optional Campus + Duration field]*

### 💡 Tips
- ទុក **Campus** ចោល = កម្មវិធីដែលអាចចូលរួមបានទាំងគ្រប់សាខា / Leave **Campus** blank to make the program available across all branches.

### ✅ Mini Checklist
- [ ] Program code is unique within an academy
- [ ] Duration matches your curriculum design

---

## 6️⃣ Subjects — មុខវិជ្ជា

> 🟡 **Audience: Super Admin · Academy Admin**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| មុខវិជ្ជានៅក្នុងកម្មវិធីសិក្សា — ឧ. Reading 101, Algebra 1, Programming Basics។ | Subjects belonging to a program — e.g. Reading 101, Algebra 1, Programming Basics. |

### 📝 Step-by-step

#### Create
1. Sidebar → **Curriculum** → **Subjects** → **+ Create**.
2. បំពេញ / Fill:
    - **Academy*** · **Program***
    - **Name*** · **Code***
    - Credit (decimal — e.g. 3.0)
    - Description
    - **Status**: Active / Inactive
3. **Save**.

🖼️ *[Insert screenshot: Subject modal with Program dropdown and Credit numeric input]*

### 💡 Tips
- **Code** គួរតែឯកសណ្ឋាន — ឧ. `ENG101`, `MATH201` / Use a consistent code scheme — e.g. `ENG101`, `MATH201`.

### ✅ Mini Checklist
- [ ] Subject linked to a Program
- [ ] Credit value is non-negative

---

## 7️⃣ Teachers — គ្រូបង្រៀន

> 🔵 **Audience: Academy Admin · Campus Manager**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| គ្រប់គ្រងព័ត៌មានគ្រូបង្រៀន — អត្តលេខ, ឈ្មោះ, ការទំនាក់ទំនង, គុណវុឌ្ឍិ, ប្រាក់ខែ, និងស្ថានភាព។ | Manage teachers — code, name, contact, qualifications, salary, status. |

### 📝 Step-by-step

#### Create
1. Sidebar → **People** → **Teachers** → **+ Create**.
2. បំពេញ / Fill:
    - **Academy*** · **Campus***
    - Linked User (optional — to allow this teacher to log in)
    - **Teacher Code*** (unique)
    - **Name*** · Gender · DOB
    - Phone, Email, Address
    - Qualification, Specialization, Joining Date
    - **Salary Type*** — Fixed / Per Class / Per Session
    - Salary Amount
    - **Status*** — Active / Inactive / Resigned
3. **Save**.

🖼️ *[Insert screenshot: Teacher modal with all 16 fields grouped into sections]*

### 💡 Tips
- ភ្ជាប់ Teacher ទៅ User បើគ្រូត្រូវចូលប្រើប្រព័ន្ធ / Link a Teacher to a User if the teacher will log in.

### ⚠️ Warnings
- ការផ្លាស់ប្តូរ Campus នឹង orphan Class Rooms ដែលផ្តល់ឱ្យ teacher នេះ — សូម review បន្ទាប់ / Changing Campus may orphan classrooms assigned to this teacher — review afterward.

### ✅ Mini Checklist
- [ ] Teacher Code unique
- [ ] Salary Type & Amount agreed with HR
- [ ] User linked (if login required)

---

## 8️⃣ Students — និស្សិត

> 🔵 **Audience: Academy Admin · Campus Manager**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| ទិន្នន័យសិស្ស — អត្តលេខ, ការទំនាក់ទំនង, ថ្ងៃខែឆ្នាំចូលរៀន, និងស្ថានភាព។ | Student records — code, contact, admission date, status. |

### 📝 Step-by-step

#### Create
1. Sidebar → **People** → **Students** → **+ Create**.
2. បំពេញ / Fill:
    - **Academy*** · **Campus***
    - Linked User (optional)
    - **Student Code*** (unique)
    - **Name*** · Gender · DOB
    - Phone, Email, Address
    - Photo, Admission Date
    - **Status*** — Active / Inactive / Blocked
3. **Save**.

🖼️ *[Insert screenshot: Student modal with photo URL + Admission Date date-picker]*

### 💡 Tips
- ប្រើ Student Code ខ្លី (8–12 តួអក្សរ) — ឧ. `S26-00123` / Keep Student Code short — e.g. `S26-00123`.

### ⚠️ Warnings
- Blocked status គួរត្រូវប្រើតែសម្រាប់ការផ្អាក regulatory — បណ្តោះអាសន្ន, ប្រើ Inactive។ / Use Blocked only for regulatory holds; for temporary leaves use Inactive.

### ✅ Mini Checklist
- [ ] Student Code unique
- [ ] Admission Date set
- [ ] Photo (optional) accessible URL

---

## 9️⃣ Class Rooms — ថ្នាក់រៀន

> 🔵 **Audience: Academy Admin · Campus Manager**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| ថ្នាក់រៀនជាក់ស្តែង (រួម subject, semester, teacher) — ឧ. ENG101 — Sem 1 2026 — Teacher A។ | Concrete class instances (combining subject, semester, teacher) — e.g. ENG101 — Sem 1 2026 — Teacher A. |

### 📝 Step-by-step

#### Create
1. Sidebar → **Classes** → **Class Rooms** → **+ Create**.
2. បំពេញ ទាំងអស់ ៧ FKs (តម្រូវ — មិនអាច blank): / Fill all 7 required FKs:
    - **Academy*** · **Campus***
    - **Program*** · **Subject***
    - **Academic Year*** · **Semester***
    - **Teacher***
    - **Class Code*** · **Name***
    - Room No., Start/End Date, Max Students
    - **Status*** — Active / Closed / Inactive
3. **Save**.

🖼️ *[Insert screenshot: Class Room modal with cascading dropdowns Academy→Campus→Program→Subject etc.]*

### 💡 Tips
- បំពេញ Max Students ដើម្បីបញ្ឈប់ over-enrollment ដោយ business rule / Set Max Students to allow over-enrollment policing later.

### ⚠️ Warnings
- រាល់ ៧ FKs **ត្រូវការ** — ការទុក blank នឹងបង្ហាញ validation error។ / All 7 FKs are **required** — blank dropdowns trigger validation errors.

### ✅ Mini Checklist
- [ ] All 7 FKs selected
- [ ] Start Date ≤ End Date
- [ ] Teacher belongs to the same Campus

---

## 🔟 Enrollments — ការចុះឈ្មោះ

> 🔵 **Audience: Academy Admin · Campus Manager**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| ការចុះឈ្មោះនិស្សិតទៅថ្នាក់រៀន — រួមមាន enrollment number, date, និងស្ថានភាព។ | Enrol a student into a class room — with enrolment number, date, status. |

### 📝 Step-by-step

#### Create
1. Sidebar → **Classes** → **Enrollments** → **+ Create**.
2. បំពេញ / Fill:
    - **Academy*** · **Campus***
    - **Academic Year*** · **Semester***
    - **Program*** · **Class Room*** · **Student***
    - **Enrollment No.*** (unique)
    - **Enrollment Date***
    - **Status*** — Active / Completed / Dropped / Transferred / Cancelled
3. **Save**.

🖼️ *[Insert screenshot: Enrollment modal with Student Tom Select search + Enrollment date]*

### 💡 Tips
- ប្រើ Enrollment No. ដែលមាន prefix ឆ្នាំសិក្សា — e.g. `ENR-26-00001` / Use enrolment numbers that include the academic year prefix — e.g. `ENR-26-00001`.

### ⚠️ Warnings
- Enrollment No. ស្ទួនបញ្ឈប់ការ save / Duplicate Enrollment No. blocks the save.
- ការផ្លាស់ប្តូរ Status ទៅ Cancelled មិនបាន roll-back fees ដោយស្វ័យប្រវត្តិឡើយ (out of scope) / Changing Status to Cancelled does **not** auto-refund fees (out of scope).

### ✅ Mini Checklist
- [ ] Class Room status = Active
- [ ] Student status = Active
- [ ] Enrollment Date within Semester window

---

## 1️⃣1️⃣ Users — អ្នកប្រើ

> 🟡 **Audience: Super Admin only**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| គ្រប់គ្រងគណនីអ្នកប្រើ — ឈ្មោះ, email, ប្រភេទ, ស្ថានភាព, និង roles។ | Manage user accounts — name, email, type, status, roles. |

### 📝 Step-by-step

#### Create
1. Sidebar → **Security** → **Users** → **+ Create**.
2. បំពេញ / Fill:
    - Academy (optional) · Campus (optional)
    - **Name*** · **Email*** (unique) · Phone
    - **User Type*** — Super Admin / Admin / Teacher / Student / Finance
    - **Password*** (≥ 6 chars) + Confirm
    - Roles (multi-select)
    - **Status*** — Active / Inactive
3. **Save**.

🖼️ *[Insert screenshot: User modal with User Type select, Password + Confirm, Roles Tom Select multi]*

### 💡 Tips
- Edit Password ស្រេចចិត្ត — ទុក blank ដើម្បីរក្សា password ចាស់ / On Edit, leave password blank to keep the existing password.

### ⚠️ Warnings
- 🛡️ **Self-delete guard** — អ្នកមិនអាចលុបគណនីផ្ទាល់ខ្លួនបានឡើយ; ប៊ូតុង 🗑️ ត្រូវលាក់សម្រាប់ជួររបស់អ្នក។ / You cannot delete your own account; the 🗑️ icon is hidden on your own row.
- ការផ្លាស់ប្តូរ Email មិនត្រូវ trigger password reset ដោយស្វ័យប្រវត្តិ — សូម inform user ដោយ manual / Changing Email does not auto-trigger a password reset — inform the user manually.

### ✅ Mini Checklist
- [ ] Email unique and valid
- [ ] User Type matches role
- [ ] At least one Role assigned (unless Super Admin)

---

## 1️⃣2️⃣ Roles — តួនាទី

> 🟡 **Audience: Super Admin · Academy Admin**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| កំណត់ការបង្គុំសិទ្ធិ (permissions bundle) ដែលអាចផ្តល់ឱ្យ user ច្រើននាក់។ | Define permission bundles assignable to multiple users. |

### Default Roles (Seeded) — តួនាទីដែលមកក្នុង seed

| Slug | Name | Permissions | Khmer |
| --- | --- | --- | --- |
| `super-admin` | Super Admin | All 52 | សិទ្ធិពេញលេញ |
| `academy-admin` | Academy Admin | All 52 (scoped to academy) | សិទ្ធិពេញលេញលើសាលា |
| `campus-manager` | Campus Manager | 17 (CRUD on people/classes/enrollments + view-only on calendar/curriculum) | គ្រប់គ្រងសាខា |
| `teacher` | Teacher | 7 (view-only) | មើលថ្នាក់ មុខវិជ្ជា និស្សិត |
| `student` | Student | 0 | អប្បបរមា |

### 📝 Step-by-step

#### Create
1. Sidebar → **Security** → **Roles** → **+ Create**.
2. បំពេញ / Fill:
    - Academy (optional — blank = global role)
    - **Name*** · Slug (auto-generated if blank)
    - Permissions — multi-select grouped by module
    - **Status** — Active / Inactive
3. **Save**.

🖼️ *[Insert screenshot: Role modal with grouped permission checkboxes (academy.*, campus.*, …)]*

### 💡 Tips
- Slug គឺ auto-derived ពី Name — ឧ. "Campus Manager" → `campus-manager` / Slug is auto-derived from Name — e.g. "Campus Manager" → `campus-manager`.

### ⚠️ Warnings
- កុំ delete role `super-admin` ឬ `academy-admin` — ប្រព័ន្ធពឹងផ្អែកលើ slug ទាំងនេះ។ / Do not delete the `super-admin` or `academy-admin` roles — the system relies on these slugs.

### ✅ Mini Checklist
- [ ] Role slug unique
- [ ] Permissions match intent
- [ ] Status = Active

---

## 1️⃣3️⃣ Permissions — សិទ្ធិ

> 🟡 **Audience: Super Admin only**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| កំណត់ atomic actions — ឧ. `student.view`, `student.create`។ | Atomic actions — e.g. `student.view`, `student.create`. |

### Default Permission Matrix — តារាងសិទ្ធិ (52 perms)

| Module | view | create | edit | delete |
| --- | :-: | :-: | :-: | :-: |
| academy | ✓ | ✓ | ✓ | ✓ |
| campus | ✓ | ✓ | ✓ | ✓ |
| user | ✓ | ✓ | ✓ | ✓ |
| role | ✓ | ✓ | ✓ | ✓ |
| permission | ✓ | ✓ | ✓ | ✓ |
| academic_year | ✓ | ✓ | ✓ | ✓ |
| semester | ✓ | ✓ | ✓ | ✓ |
| program | ✓ | ✓ | ✓ | ✓ |
| subject | ✓ | ✓ | ✓ | ✓ |
| teacher | ✓ | ✓ | ✓ | ✓ |
| student | ✓ | ✓ | ✓ | ✓ |
| class_room | ✓ | ✓ | ✓ | ✓ |
| enrollment | ✓ | ✓ | ✓ | ✓ |

### 📝 Step-by-step

#### Create
1. Sidebar → **Security** → **Permissions** → **+ Create**.
2. បំពេញ / Fill:
    - **Module*** — e.g. `report`
    - **Name*** — e.g. `Generate Monthly Report`
    - Slug (auto — `report.monthly`) — leave blank
    - Description
3. **Save**.

> ⚠️ Slug auto-generates from `module.name` (lowercased, dot-separated) **before** validation runs (PR #3 fix). Duplicate slugs surface as an inline error, not a 500.

### ✅ Mini Checklist
- [ ] Module name matches code convention (lowercase, underscore)
- [ ] Slug unique
- [ ] Description explains the action clearly

---

## 1️⃣4️⃣ Profile — ប្រវត្តិរូប

> 🟢 **Audience: All authenticated users**

### 🎯 Purpose
| ខ្មែរ | English |
| --- | --- |
| កែឈ្មោះ, email, phone, និងផ្លាស់ប្តូរ password របស់អ្នកប្រើខ្លួន។ | Edit your own name, email, phone, and change your password. |

### 📝 Step-by-step

#### Update Profile Info
1. ចុចលើ avatar → **Profile** / Click avatar → **Profile**.
2. ផ្លាស់ប្តូរ Name / Email / Phone / Edit Name / Email / Phone.
3. **Save** (ផ្នែកខាងឆ្វេង) / **Save** (left card).

#### Change Password
1. នៅផ្នែកខាងស្តាំ — បំពេញ Current Password, New Password (≥6 chars), Confirm. / On the right card — fill Current Password, New Password (≥6 chars), Confirm.
2. **Save**.

🖼️ *[Insert screenshot: Profile page with two-card layout — Update info | Change password]*

### 💡 Tips
- ប្រើ password manager / Use a password manager.
- ប្រសិនបើ Email ផ្លាស់ប្តូរ — សូម logout/login ដើម្បីបន្ត session ស្អាត។ / If you change your Email, logout/login for a clean session.

### ✅ Mini Checklist
- [ ] Name + Email correct
- [ ] Password changed periodically
- [ ] Phone reachable

---

# 🔄 End-to-End Workflow Scenarios — ករណីប្រើពិតជាក់ស្តែង

## Scenario 1 — Onboarding a brand-new academy (Super Admin)
### ការតំឡើងសាលាថ្មីពីដំបូង

| Step | ខ្មែរ | English |
| --- | --- | --- |
| 1 | ចូលប្រើជា Super Admin (`admin@example.com`) | Login as Super Admin |
| 2 | **Academies → + Create** — បំពេញ Name, Code, Owner | **Academies → + Create** — fill Name, Code, Owner |
| 3 | **Campuses → + Create** — បង្កើតសាខាមេ (Is Main ✓) | **Campuses → + Create** — create main campus (Is Main ✓) |
| 4 | **Users → + Create** — បង្កើត Academy Admin, កំណត់ role `academy-admin` | **Users → + Create** — create Academy Admin user, assign role `academy-admin` |
| 5 | ចេញ logout, ចូលជា Academy Admin | Logout, login as Academy Admin |
| 6 | **Academic Years → + Create** — ឧ. `2026–2027`, Is Current ✓ | **Academic Years → + Create** — e.g. `2026–2027`, Is Current ✓ |
| 7 | **Semesters → + Create** ×2 (Sem 1, Sem 2) | **Semesters → + Create** ×2 |
| 8 | **Programs → + Create** ×N (English, Math, …) | **Programs → + Create** ×N |
| 9 | **Subjects → + Create** សម្រាប់រាល់ program | **Subjects → + Create** under each program |

> ✅ **Outcome — លទ្ធផល**
> សាលាមួយ, សាខាមួយ, ឆ្នាំសិក្សាដែលដំណើរការ, Academy Admin ដែលអាចចូលប្រើ, និងផែនការសិក្សា complete។
> One academy, one campus, an active academic year, a working Academy Admin login, and a complete curriculum.

---

## Scenario 2 — Rolling out a new semester (Academy Admin → Campus Manager)
### ការបើកឆមាសថ្មី

| Step | ខ្មែរ | English |
| --- | --- | --- |
| 1 | Academy Admin: **Semesters → + Create** — `Semester 1 2026/27` | Academy Admin: **Semesters → + Create** — `Semester 1 2026/27` |
| 2 | Academy Admin: **Academic Years** — set Is Current ✓ on the right year | Academy Admin: **Academic Years** — set Is Current ✓ on the right year |
| 3 | Academy Admin: **Users → + Create** — បង្កើត Campus Manager user, role `campus-manager` | Create Campus Manager user, role `campus-manager` |
| 4 | Campus Manager logs in | Campus Manager logs in |
| 5 | Campus Manager: **Teachers → + Create** ×N | Create Teachers |
| 6 | Campus Manager: **Class Rooms → + Create** ×N — link Subject + Teacher + AY + Semester | Create Class Rooms — linking Subject + Teacher + AY + Semester |
| 7 | Campus Manager: **Students → + Create** ×N (or import) | Create Students |
| 8 | Campus Manager: **Enrollments → + Create** ×N — assign Students to Class Rooms | Create Enrollments — assign Students to Class Rooms |

> ✅ **Outcome — លទ្ធផល**
> ឆមាសថ្មីដែលដំណើរការពេញលេញ — ស្ថានភាព Active, គ្រូ និងសិស្សត្រូវបានចុះឈ្មោះ។
> A fully-running new semester — Active status, teachers and students enrolled.

---

## Scenario 3 — End-of-term close-out (Academy Admin + Manager)
### ការបិទឆមាស

| Step | ខ្មែរ | English |
| --- | --- | --- |
| 1 | Campus Manager: review **Enrollments** — flip Active → Completed for each Class Room | Review **Enrollments** — flip Active → Completed for each completed class |
| 2 | Academy Admin: **Semesters** — change Status of finished semester to `Closed` | **Semesters** — change Status of finished semester to `Closed` |
| 3 | Academy Admin: **Class Rooms** — change Status of finished class to `Closed` | **Class Rooms** — change Status to `Closed` |
| 4 | Academy Admin: **Academic Years** — keep Is Current ✓ until next AY rolled in | Keep Is Current ✓ until next AY is rolled in |
| 5 | Super Admin: **Roles → Teachers** — review permission grants for next term | **Roles → Teachers** — review permission grants for next term |
| 6 | Super Admin: archive — set inactive Users to `Inactive` (do not delete) | Archive — set inactive Users to `Inactive` (do not delete) |

> ✅ **Outcome — លទ្ធផល**
> ប្រព័ន្ធរក្សាការតាមដាន historical, និងត្រៀមខ្លួនសម្រាប់ឆមាសបន្ទាប់។
> The system retains historical tracking and is primed for the next semester.

---

# 🛡️ Best Practices & Standards — បទដ្ឋាន

## Coding & Convention Standards (សម្រាប់ Admin/Dev)

| Standard | ខ្មែរ | English |
| --- | --- | --- |
| **Code style** | PHP — Laravel Pint (PSR-12) | PHP — Laravel Pint (PSR-12) |
| **CRUD style** | រាល់ Create/Edit/Delete ប្រើ Livewire modal | All Create/Edit/Delete go through Livewire modals |
| **DataTables** | Server-side processing (Yajra) | Server-side processing (Yajra) |
| **Delete UX** | SweetAlert2 confirmation | SweetAlert2 confirmation |
| **Locale** | EN (default) · KM (Khmer) | EN (default) · KM (Khmer) |
| **Permissions** | `module.action` slug — e.g. `student.view` | `module.action` slug |
| **Soft delete** | User, Academy, Campus | User, Academy, Campus |
| **Auth** | Session-based, password hashed (bcrypt) | Session-based, bcrypt |

## Data Hygiene — អនាម័យទិន្នន័យ

> ✅ **Do — ត្រូវ**
> - ប្រើ code ឯកសណ្ឋាន (uppercase, prefix per module)
> - រក្សា Is Main ✓ មួយប៉ុណ្ណោះក្នុងសាលា
> - រក្សា Is Current ✓ មួយប៉ុណ្ណោះក្នុង Academy Year
> - Soft-delete (Inactive status) ជំនួសការលុបពិតប្រាកដ
> - ផ្តល់ Role យ៉ាងតិច ១ ឱ្យ user ថ្មី (មិនមែន Super Admin)

> ⚠️ **Don't — មិនត្រូវ**
> - កុំ delete `super-admin` role
> - កុំ assign `super-admin` role ដោយគ្មានការអនុញ្ញាត
> - កុំ delete user ដែលជាអ្នកគ្រប់គ្រងសាខា — re-assign ជាមុន
> - កុំប្រើ password `password` នៅ production

## Security Standards — បទដ្ឋានសុវត្ថិភាព

| Item | Khmer | English |
| --- | --- | --- |
| Password length | យ៉ាងតិច ៦ តួអក្សរ (recommend ១២+) | Minimum 6 chars (recommend 12+) |
| Password hashing | bcrypt (auto) | bcrypt (auto) |
| Session cookie | HTTP-only, SameSite=Lax | HTTP-only, SameSite=Lax |
| CSRF | Laravel CSRF token គ្រប់ POST | Laravel CSRF token on all POST |
| HTTPS | ត្រូវបើកក្នុង production | Required in production |
| Self-delete guard | មិនអាចលុបខ្លួនឯងបាន | Cannot delete your own account |

---

# ❓ FAQ & Troubleshooting — សំណួរញឹកញាប់

<details>
<summary><b>Q1 — តើខ្ញុំភ្លេច password ដោយរបៀបណា? / I forgot my password — what should I do?</b></summary>

ឆ្លើយ / Answer:
សូមស្នើ Super Admin ឱ្យ reset password តាមរយៈ **Users → Edit** ហើយបំពេញ password ថ្មី + Confirm។
Ask a Super Admin to reset your password via **Users → Edit** by setting a new password + Confirm.

</details>

<details>
<summary><b>Q2 — ហេតុអ្វី Save button មិនចុចបាន? / Why is the Save button disabled?</b></summary>

ឆ្លើយ / Answer:
សូមពិនិត្យ inline errors ក្នុង modal — រាល់ Validation error បង្ហាញពណ៌ក្រហម។ ត្រូវកែឱ្យចប់សិន។
Check inline errors inside the modal — every validation error is highlighted in red. Fix them first.

</details>

<details>
<summary><b>Q3 — ហេតុអ្វី Sidebar ខ្លះមិនបង្ហាញ? / Why don't I see some sidebar items?</b></summary>

ឆ្លើយ / Answer:
ប្រព័ន្ធបង្ហាញ Sidebar item តាមសិទ្ធិ (permissions)។ បើគ្មាន `module.view` Module នោះនឹងលាក់។
The sidebar uses `@can()` directives. If you don't have `module.view`, that module is hidden.

</details>

<details>
<summary><b>Q4 — តើខ្ញុំអាចបង្កើត Class Room ដោយ Subject blank បានទេ? / Can I create a Class Room with Subject left blank?</b></summary>

ឆ្លើយ / Answer:
មិនបាន។ Class Room តម្រូវឱ្យមាន Subject + Academy + Campus + Program + Academic Year + Semester + Teacher ទាំងអស់។
No. Class Room requires Subject + Academy + Campus + Program + Academic Year + Semester + Teacher — all 7 FKs.

</details>

<details>
<summary><b>Q5 — ការប្តូរភាសាទៅ Khmer បង្កើនទំហំ font ដោយរបៀបណា? / How do I increase font size for Khmer?</b></summary>

ឆ្លើយ / Answer:
ប្រព័ន្ធដំឡើង CSS Khmer font helper ដោយស្វ័យប្រវត្តិ — សម្រាប់ font ផ្ទាល់ខ្លួន សូម contact admin។
The system auto-applies a Khmer font helper. For custom fonts, contact the admin.

</details>

<details>
<summary><b>Q6 — ហេតុអ្វី Delete រួចហើយ data នៅឃើញ? / Why does data still appear after delete?</b></summary>

ឆ្លើយ / Answer:
DataTable refresh ឡើងតាម `datatable:reload` event — សូម verify ថា SweetAlert ត្រូវបាន confirmed មុនពេលដែលអ្នកគិតថា delete។
DataTable reloads on the `datatable:reload` event. Verify the SweetAlert confirmation actually fired (you clicked "Confirm").

</details>

<details>
<summary><b>Q7 — តើខ្ញុំអាច bulk-import students បានទេ? / Can I bulk-import students?</b></summary>

ឆ្លើយ / Answer:
ផែនការអនាគត — បច្ចុប្បន្ននេះ បង្កើតម្តងមួយ ឬប្រើ seed script (developer)។
Bulk import is on the roadmap. For now, create one-by-one in UI or use a seeder script (developer).

</details>

<details>
<summary><b>Q8 — Modal បើកមិនបាន (ឬចេញលាក់ភ្លាមៗ) / Modal doesn't open (or closes immediately)</b></summary>

ឆ្លើយ / Answer:
- ត្រួតពិនិត្យ console (F12) — បើ Livewire JS បរាជ័យ, refresh ទំព័រ
- ត្រួតពិនិត្យថា JavaScript មិនត្រូវបាន blocked ដោយ browser extensions
- កង់ Bootstrap modal ត្រូវការ `data-bs-toggle="modal"` — generated by Livewire ស្វ័យប្រវត្តិ

Check the browser console (F12). If Livewire JS failed, refresh the page. Check that JavaScript isn't blocked by browser extensions. Bootstrap modal requires `data-bs-toggle="modal"` — Livewire emits this automatically.

</details>

<details>
<summary><b>Q9 — ការ logout មិនដំណើរការ — ហេតុអ្វី? / Logout doesn't work — why?</b></summary>

ឆ្លើយ / Answer:
Logout ត្រូវការ POST + CSRF token។ ប្រសិនបើទំព័របានបើកយូរ session អាច expire — refresh ហើយ logout ម្តងទៀត។
Logout requires POST + CSRF token. If the page is stale the session may have expired — refresh and click Logout again.

</details>

<details>
<summary><b>Q10 — តើខ្ញុំអាចលុបខ្លួនឯងបានទេ? / Can I delete my own account?</b></summary>

ឆ្លើយ / Answer:
មិនបាន — ប៊ូតុង 🗑️ លាក់សម្រាប់ជួររបស់អ្នកដោយ "self-delete guard"។
No — the 🗑️ button is hidden on your own row by the self-delete guard.

</details>

<details>
<summary><b>Q11 — តើ Academy Year មួយណាជា "current"? / Which Academic Year is "current"?</b></summary>

ឆ្លើយ / Answer:
ឆ្នាំសិក្សាដែលមាន **Is Current** ✓។ ត្រូវមានតែមួយក្នុងសាលា — Edit ឱ្យត្រឹមត្រូវប្រសិនបើច្រើនជាងមួយ។
The one with **Is Current** ✓. There should be exactly one per academy — edit if multiples exist.

</details>

<details>
<summary><b>Q12 — ហេតុអ្វី Code field បង្ហាញ "already taken"? / Why does the Code field show "already taken"?</b></summary>

ឆ្លើយ / Answer:
Code និង Slug គឺ unique — ការផ្លាស់ប្តូរទៅ value ដែលមាន user ផ្សេងកំពុងប្រើនឹង inline error។
Code and Slug are unique — changing to a value used by another row triggers an inline validation error.

</details>

<details>
<summary><b>Q13 — អាច switch ភាសាដោយមិនត្រូវ logout បានទេ? / Can I switch language without logging out?</b></summary>

ឆ្លើយ / Answer:
បាន — ការប្តូរភាសាគ្រាន់តែ update session/cookie ប៉ុណ្ណោះ; session អ្នកនៅរក្សា។
Yes — switching language just updates session/cookie; your auth session is preserved.

</details>

<details>
<summary><b>Q14 — ហេតុអ្វី Profile Save មិនបង្ហាញ toast? / Why no toast after Profile Save?</b></summary>

ឆ្លើយ / Answer:
Profile ប្រើ POST/PATCH traditional (មិនមែន Livewire) — Save នឹង redirect-after-POST ហើយបង្ហាញ flash message (បើ configured)។ Reload ដើម្បីពិនិត្យ persistence។
Profile uses traditional POST/PATCH (not Livewire). Save triggers a redirect-after-POST and shows a flash message (if configured). Reload to verify persistence.

</details>

<details>
<summary><b>Q15 — តើ session timeout យូរ? / How long is the session timeout?</b></summary>

ឆ្លើយ / Answer:
បាន config នៅ `config/session.php` — តម្លៃ default 120 នាទី (2 ម៉ោង)។ Admin អាច adjust។
Configured in `config/session.php` — default is 120 minutes (2 hours). Admin can adjust.

</details>

---

# 📘 Glossary — វាក្យសព្ទ

| Khmer | English | និយមន័យ / Definition |
| --- | --- | --- |
| សាលា | Academy | អង្គភាពកម្រិតលើ — អាចមានសាខាច្រើន / Top-level entity — can have multiple campuses |
| សាខា | Campus / Branch | ទីតាំងជាក់លាក់របស់សាលា / Specific physical location of an academy |
| ឆ្នាំសិក្សា | Academic Year | រយៈពេលសិក្សា (e.g. 2026–2027) / Academic period (e.g. 2026–2027) |
| ឆមាស | Semester | ផ្នែកនៃឆ្នាំសិក្សា (e.g. Sem 1, Sem 2) / Section of an academic year |
| កម្មវិធីសិក្សា | Program | ផ្លូវសិក្សា (e.g. English, Math) / Course of study (e.g. English, Math) |
| មុខវិជ្ជា | Subject | ផ្នែកនៃកម្មវិធីសិក្សា / Section of a program |
| ថ្នាក់រៀន | Class Room | កាលវិភាគជាក់ស្តែង (Subject × Semester × Teacher) / Concrete schedule instance |
| ការចុះឈ្មោះ | Enrollment | ការផ្គូផ្គងសិស្ស ↔ ថ្នាក់រៀន / Pairing of student ↔ class room |
| គ្រូ | Teacher | បុគ្គលិកបង្រៀន / Teaching staff |
| សិស្ស / និស្សិត | Student | អ្នកសិក្សា / Learner |
| អ្នកប្រើ | User | គណនីដែលអាច login / A login-capable account |
| តួនាទី | Role | បណ្តុំសិទ្ធិ / Bundle of permissions |
| សិទ្ធិ | Permission | សកម្មភាព atomic (e.g. `student.view`) / Atomic action |
| ស្ថានភាព | Status | Active / Inactive / Closed / Dropped / Cancelled |
| Dashboard | Dashboard | ផ្ទាំងទិន្នន័យ stats / Stats overview |
| Modal | Modal | ប្រអប់ pop-up សម្រាប់ Create/Edit / Pop-up box for Create/Edit |
| DataTable | DataTable | តារាងទិន្នន័យ server-side / Server-side data grid |
| Toast | Toast | សារ pop-up ខ្លី / Brief pop-up message |
| SweetAlert | SweetAlert | ការបញ្ជាក់ delete / Confirmation dialog |
| Tom Select | Tom Select | dropdown ស្វែងរក / Searchable dropdown |
| Livewire | Livewire | កញ្ចប់ Laravel សម្រាប់ reactive UI / Laravel package for reactive UI |
| Bootstrap 5 | Bootstrap 5 | CSS framework | CSS framework |
| Pint | Pint | Laravel code formatter | Laravel code formatter |
| CSRF | CSRF | Cross-Site Request Forgery token | Cross-Site Request Forgery token |
| Locale | Locale | ភាសា (en / km) / Language (en / km) |
| FK | Foreign Key | សោភ្ជាប់តារាង / Foreign key constraint |
| Soft delete | Soft delete | លុបដោយ flag (មិនលុបពិត) / Flag-based delete (row retained) |
| Self-delete guard | Self-delete guard | ការការពារមិនឱ្យលុបខ្លួនឯង / Block deleting one's own account |
| Seed | Seed | ទិន្នន័យ demo ដែលបង្កើតដោយស្វ័យប្រវត្តិ / Auto-generated demo data |
| Migration | Migration | script បង្កើតតារាង DB / DB schema script |

---

# ✅ Final Checklist for Customers — បញ្ជីត្រួតពិនិត្យចុងក្រោយ

> ℹ️ ប្រើ checkbox toggle ខាងក្រោម ដើម្បីបញ្ជាក់ការបញ្ចប់ការបណ្តុះបណ្តាល។
> Use the checkboxes below to confirm training completion.

## Login & Navigation
- [ ] ខ្ញុំអាចចូលប្រើដោយជោគជ័យ / I can log in successfully
- [ ] ខ្ញុំស្គាល់ Sidebar, Top Bar, និង Breadcrumb / I understand the Sidebar, Top Bar, and Breadcrumb
- [ ] ខ្ញុំអាចប្តូរ EN ↔ KM បាន / I can switch between EN and KM
- [ ] ខ្ញុំអាចចេញ (Logout) បាន / I can log out

## Profile
- [ ] ខ្ញុំបានកែឈ្មោះ / phone របស់ខ្ញុំ / I have updated my own name / phone
- [ ] ខ្ញុំបានផ្លាស់ប្តូរ password / I have changed my password

## CRUD modules (សម្រាប់ Admin / Manager)
- [ ] ខ្ញុំបាន Create + Edit + Delete Academy
- [ ] ខ្ញុំបាន Create + Edit + Delete Campus
- [ ] ខ្ញុំបាន Create + Edit + Delete Academic Year + Semester
- [ ] ខ្ញុំបាន Create + Edit + Delete Program + Subject
- [ ] ខ្ញុំបាន Create + Edit + Delete Teacher
- [ ] ខ្ញុំបាន Create + Edit + Delete Student
- [ ] ខ្ញុំបាន Create + Edit + Delete Class Room (with all 7 FKs)
- [ ] ខ្ញុំបាន Create + Edit + Delete Enrollment
- [ ] ខ្ញុំបាន Create + Edit + Delete User (with role)
- [ ] ខ្ញុំបាន Create + Edit + Delete Role (with permissions)
- [ ] ខ្ញុំបាន Create + Edit + Delete Permission

## Workflows
- [ ] ខ្ញុំបានបញ្ចប់ Scenario 1 — Onboarding a new academy
- [ ] ខ្ញុំបានបញ្ចប់ Scenario 2 — Rolling out a new semester
- [ ] ខ្ញុំបានបញ្ចប់ Scenario 3 — End-of-term close-out

## Security & Best Practices
- [ ] ខ្ញុំយល់ self-delete guard / I understand the self-delete guard
- [ ] ខ្ញុំស្គាល់ Default Roles ៥ និងសិទ្ធិ ៥២ / I know the 5 default roles and 52 permissions
- [ ] ខ្ញុំបានផ្លាស់ប្តូរ default password / I have rotated default passwords
- [ ] ខ្ញុំស្គាល់ "Is Main" និង "Is Current" ច្បាប់ / I understand "Is Main" and "Is Current" rules

---

> 🎉 **End of Training Manual — ចប់សៀវភៅណែនាំ**
> សួស្ដី! សូមរក្សាសៀវភៅនេះក្នុង Notion workspace របស់អ្នក និងធ្វើបច្ចុប្បន្នភាពតាមលក្ខណៈពិសេសថ្មីៗ។
> Congratulations! Keep this manual in your Notion workspace and update it as new features ship.
