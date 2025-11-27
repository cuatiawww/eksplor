# 📚 Dokumentasi Task Table - Fitur & Implementasi

## 🎯 Overview
Dokumentasi lengkap implementasi task table dengan DataTables, filtering, sorting, pagination, tooltips, dan bulk delete functionality.

---

## 📁 File yang Dimodifikasi

### 1. **views/layouts/main.php**
**Tujuan**: Menambahkan jQuery sebagai dependency utama

```php
<!-- jQuery (required for DataTables and other plugins) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
```

**Penjelasan**:
- jQuery harus dimuat **sebelum** semua plugin lain
- DataTables, Flatpickr, dan Bootstrap memerlukan jQuery

---

### 2. **views/task/index.php**
**Tujuan**: Implementasi lengkap task table dengan semua fitur

---

## 🎨 CSS Classes & Styling

### **A. Table Styling - Odd/Even Rows**

```css
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.02);
}

.table-striped tbody tr:nth-of-type(even) {
    background-color: #ffffff;
}
```

**Penjelasan**:
- `.table-striped` = Class Bootstrap untuk table dengan stripe pattern
- `tbody tr:nth-of-type(odd)` = Selector untuk baris ganjil (1, 3, 5, ...)
- `tbody tr:nth-of-type(even)` = Selector untuk baris genap (2, 4, 6, ...)
- `rgba(0, 0, 0, 0.02)` = Warna hitam dengan opacity 2% (abu-abu sangat terang)

---

### **B. Hover Effect**

```css
.table-striped tbody tr:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.05) !important;
}
```

**Penjelasan**:
- `tr:hover` = Trigger saat mouse di atas baris
- `var(--bs-primary-rgb)` = Menggunakan warna primary dari Bootstrap (CSS variable)
- `0.05` = Opacity 5%
- `!important` = Override style lain

---

### **C. Filter Input Styling (Footer)**

```css
tfoot input,
tfoot select {
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
}
```

**Penjelasan**:
- `tfoot` = Footer table (tempat filter berada)
- `0.375rem` = 6px (1rem = 16px)
- `0.75rem` = 12px
- `0.875rem` = 14px
- `#dee2e6` = Warna border abu-abu terang
- `border-radius` = Membuat sudut melengkung

---

### **D. DataTables Pagination Styling**

```css
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: var(--bs-primary) !important;
    color: white !important;
    border-color: var(--bs-primary) !important;
}
```

**Penjelasan**:
- `.dataTables_wrapper` = Container DataTables
- `.dataTables_paginate` = Container pagination
- `.paginate_button` = Tombol pagination
- `.current` = Halaman aktif saat ini

---

### **E. Column Header Sorting Styles**

```css
#task-table thead th {
    cursor: pointer;
    user-select: none;
    position: relative;
    padding-right: 30px !important;
}
```

**Penjelasan**:
- `cursor: pointer` = Pointer mouse berubah jadi tangan (clickable)
- `user-select: none` = Text tidak bisa diselect
- `position: relative` = Untuk positioning icon sort
- `padding-right: 30px` = Ruang untuk icon sort di kanan

---

### **F. Sorting Icons**

```css
table.dataTable thead .sorting {
    background-image: url("data:image/svg+xml,...");
}

table.dataTable thead .sorting_asc {
    background-image: url("data:image/svg+xml,...");
}

table.dataTable thead .sorting_desc {
    background-image: url("data:image/svg+xml,...");
}
```

**Penjelasan**:
- `.sorting` = Kolom yang bisa disort (default, tidak aktif)
- `.sorting_asc` = Kolom sedang sort ascending (A→Z, 1→9)
- `.sorting_desc` = Kolom sedang sort descending (Z→A, 9→1)
- `data:image/svg+xml` = SVG embedded langsung di CSS (tidak perlu file terpisah)

**Icon SVG**:
- **Sorting (inactive)**: ↕ (double arrow abu-abu)
- **Sorting Asc**: ↑ (arrow up biru)
- **Sorting Desc**: ↓ (arrow down biru)

---

### **G. Hover Effect for Headers**

```css
#task-table thead th:hover:not(:first-child):not(:last-child) {
    background-color: rgba(var(--bs-primary-rgb), 0.05);
}
```

**Penjelasan**:
- `:hover` = Saat mouse di atas header
- `:not(:first-child)` = Kecuali kolom pertama (checkbox)
- `:not(:last-child)` = Kecuali kolom terakhir (actions)

---

## 🏷️ Bootstrap Classes yang Digunakan

### **1. Layout & Grid**
```html
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="card-body">
```

**Penjelasan**:
- `row` = Container untuk kolom Bootstrap grid
- `col-md-12` = Kolom dengan lebar 12/12 (full width) pada medium screen
- `card` = Komponen card Bootstrap
- `card-header` = Header card
- `card-body` = Body/isi card

---

### **2. Buttons**

```html
<button class="btn btn-primary">
<button class="btn btn-danger">
<button class="btn btn-secondary">
```

**Penjelasan**:
- `btn` = Base class untuk button
- `btn-primary` = Button warna primary (biru)
- `btn-danger` = Button warna merah (delete)
- `btn-secondary` = Button warna abu-abu (cancel)

---

### **3. Badges**

```html
<span class="badge bg-light-primary">
<span class="badge bg-light-danger">
<span class="badge bg-light-success">
```

**Penjelasan**:
- `badge` = Tag kecil untuk label
- `bg-light-primary` = Background primary terang
- `bg-light-danger` = Background danger terang (merah)
- `bg-light-success` = Background success terang (hijau)

---

### **4. Table Classes**

```html
<table class="table table-hover table-striped">
```

**Penjelasan**:
- `table` = Base class untuk table Bootstrap
- `table-hover` = Efek hover pada baris
- `table-striped` = Baris bergaris-garis (odd/even)

---

### **5. Form Classes**

```html
<input class="form-control form-control-sm">
<select class="form-select form-select-sm">
<div class="form-check">
  <input class="form-check-input">
```

**Penjelasan**:
- `form-control` = Style untuk input text
- `form-control-sm` = Small size
- `form-select` = Style untuk dropdown select
- `form-check` = Container untuk checkbox/radio
- `form-check-input` = Style untuk checkbox

---

### **6. Modal Classes**

```html
<div class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <div class="modal-body">
      <div class="modal-footer">
```

**Penjelasan**:
- `modal` = Base class modal
- `fade` = Animasi fade in/out
- `modal-dialog` = Dialog container
- `modal-dialog-centered` = Modal di tengah layar
- `modal-content` = Konten modal
- `modal-header` = Header modal
- `modal-body` = Body modal
- `modal-footer` = Footer modal (biasanya ada tombol)

---

### **7. Tooltip**

```html
<span data-bs-toggle="tooltip"
      data-bs-placement="top"
      title="Tooltip text">
```

**Penjelasan**:
- `data-bs-toggle="tooltip"` = Aktifkan tooltip Bootstrap
- `data-bs-placement` = Posisi tooltip (top/bottom/left/right)
- `title` = Text yang ditampilkan di tooltip

---

## 🔧 DataTables Configuration

### **Initialization**

```javascript
taskTable = $('#task-table').DataTable({
    pageLength: 5,
    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    order: [[1, 'asc']],
    columnDefs: [
        { orderable: false, targets: [0, 11] },
        { searchable: false, targets: [0, 11] }
    ]
});
```

**Penjelasan**:
- `pageLength: 5` = Tampilkan 5 baris per halaman
- `lengthMenu` = Opsi jumlah baris (5, 10, 25, 50, All)
- `order: [[1, 'asc']]` = Sort default kolom ke-1 (Title) ascending
- `orderable: false` = Kolom 0 (checkbox) dan 11 (actions) tidak bisa disort
- `searchable: false` = Kolom 0 dan 11 tidak bisa di-search

---

### **Language Customization**

```javascript
language: {
    search: "Search:",
    lengthMenu: "Show _MENU_ entries",
    info: "Showing _START_ to _END_ of _TOTAL_ tasks",
    infoEmpty: "Showing 0 to 0 of 0 tasks",
    infoFiltered: "(filtered from _MAX_ total tasks)",
    paginate: {
        first: "First",
        last: "Last",
        next: "Next",
        previous: "Previous"
    }
}
```

**Penjelasan**:
- `_MENU_` = Placeholder untuk dropdown jumlah entries
- `_START_` = Nomor item pertama yang ditampilkan
- `_END_` = Nomor item terakhir yang ditampilkan
- `_TOTAL_` = Total semua items
- `_MAX_` = Total items sebelum filter

---

### **DrawCallback**

```javascript
drawCallback: function() {
    initTooltips();
}
```

**Penjelasan**:
- Dijalankan setiap kali table di-redraw (pagination, sort, filter)
- Reinitialize tooltips agar tetap berfungsi

---

## 🔍 Column Filters Implementation

### **1. Text Search Filter (Title, Description, Tags)**

```javascript
footer.html('<input type="text" class="form-control form-control-sm" placeholder="Search title..." />');
$('input', footer).on('keyup change', function () {
    if (column.search() !== this.value) {
        column.search(this.value).draw();
    }
});
```

**Penjelasan**:
- `footer.html()` = Inject HTML ke footer kolom
- `$('input', footer)` = Select input di footer kolom ini
- `.on('keyup change')` = Event saat user ketik atau ubah value
- `column.search()` = Fungsi search DataTables untuk kolom
- `.draw()` = Redraw table dengan hasil filter

---

### **2. Dropdown Filter (Category, Priority, Status)**

```javascript
var select = $('<select class="form-select form-select-sm"><option value="">All Categories</option></select>');
var categories = ['Work', 'Personal', 'Study', 'Health', 'Shopping'];
categories.forEach(function(cat) {
    select.append('<option value="' + cat + '">' + cat + '</option>');
});
footer.html(select);
select.on('change', function () {
    column.search(this.value).draw();
});
```

**Penjelasan**:
- `$('<select>')` = Buat element select dengan jQuery
- `forEach` = Loop array categories
- `.append()` = Tambahkan option ke select
- `.on('change')` = Event saat dropdown berubah

---

### **3. Date Picker Filter (Deadline)**

```javascript
footer.html('<input type="text" class="form-control form-control-sm flatpickr-date" placeholder="Filter by date..." />');
var dateInput = $('.flatpickr-date', footer)[0];
if (dateInput && typeof flatpickr !== 'undefined') {
    flatpickr(dateInput, {
        dateFormat: "M d",
        onChange: function(selectedDates, dateStr, instance) {
            column.search(dateStr).draw();
        }
    });
}
```

**Penjelasan**:
- `flatpickr()` = Initialize Flatpickr date picker
- `dateFormat: "M d"` = Format: Jan 28
- `onChange` = Callback saat tanggal dipilih
- `dateStr` = String tanggal yang dipilih

---

## ✅ Checkbox & Bulk Delete

### **Select All Checkbox**

```javascript
$('#select-all').on('click', function() {
    var isChecked = $(this).prop('checked');
    $('.task-checkbox:visible').prop('checked', isChecked);
    updateSelectedTasks();
});
```

**Penjelasan**:
- `#select-all` = ID checkbox di header
- `.prop('checked')` = Get/set checked status
- `.task-checkbox:visible` = Hanya checkbox yang terlihat (di halaman aktif)

---

### **Individual Checkbox**

```javascript
$(document).on('change', '.task-checkbox', function() {
    updateSelectedTasks();

    var totalVisible = $('.task-checkbox:visible').length;
    var totalChecked = $('.task-checkbox:visible:checked').length;
    $('#select-all').prop('checked', totalVisible > 0 && totalVisible === totalChecked);
});
```

**Penjelasan**:
- `$(document).on('change')` = Delegated event (untuk element dinamis)
- Update select-all checkbox jika semua individual checkbox checked

---

### **Update Selected Tasks**

```javascript
function updateSelectedTasks() {
    selectedTasks = [];
    $('.task-checkbox:checked').each(function() {
        selectedTasks.push($(this).val());
    });

    if (selectedTasks.length > 0) {
        $('#delete-selected-btn').show();
    } else {
        $('#delete-selected-btn').hide();
    }
}
```

**Penjelasan**:
- Loop semua checkbox yang checked
- Ambil value (task ID) dan push ke array
- Show/hide button delete berdasarkan jumlah selected

---

### **AJAX Bulk Delete**

```javascript
$.ajax({
    url: '/task/bulk-delete',
    type: 'POST',
    data: {
        ids: selectedTasks,
        '_csrf': 'csrf_token_value'
    },
    success: function(response) {
        // Close modal
        var modalElement = document.getElementById('deleteModal');
        var modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        }
        // Reload page
        window.location.reload();
    },
    error: function(xhr, status, error) {
        alert('Error deleting tasks. Please try again.');
    }
});
```

**Penjelasan**:
- `$.ajax()` = AJAX request dengan jQuery
- `type: 'POST'` = HTTP method
- `data` = Data yang dikirim (IDs dan CSRF token)
- `success` = Callback jika berhasil
- `error` = Callback jika error
- `bootstrap.Modal.getInstance()` = Get instance modal Bootstrap
- `window.location.reload()` = Refresh halaman

---

## 🎭 Modal Implementation

### **HTML Structure**

```html
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="ph-duotone ph-warning-circle text-danger me-2"></i>
          Confirm Delete
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <strong id="delete-count">0</strong> task(s)?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
      </div>
    </div>
  </div>
</div>
```

**Penjelasan**:
- `modal fade` = Modal dengan animasi fade
- `modal-dialog-centered` = Modal di tengah vertikal
- `ph-duotone ph-warning-circle` = Icon Phosphor (dari template)
- `text-danger` = Text warna merah
- `me-2` = Margin end (kanan) 2 unit
- `btn-close` = Tombol X untuk close modal
- `data-bs-dismiss="modal"` = Close modal saat diklik

---

### **Show Modal with JavaScript**

```javascript
var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
deleteModal.show();
```

**Penjelasan**:
- `new bootstrap.Modal()` = Create instance modal
- `.show()` = Tampilkan modal

---

## 🎨 Icon Classes (Phosphor Icons)

```html
<i class="ph-duotone ph-trash"></i>          <!-- Icon trash -->
<i class="ph-duotone ph-pencil"></i>         <!-- Icon pencil -->
<i class="ph-duotone ph-plus-circle"></i>    <!-- Icon plus -->
<i class="ph-duotone ph-warning-circle"></i> <!-- Icon warning -->
<i class="ph-duotone ph-calendar"></i>       <!-- Icon calendar -->
<i class="ph-duotone ph-check-circle"></i>   <!-- Icon check -->
```

**Penjelasan**:
- `ph-duotone` = Phosphor duotone icon style
- `ph-*` = Nama icon

---

## 📊 Utility Classes Template

### **Spacing Classes**
```
m-0, m-1, m-2, m-3, m-4, m-5   = Margin all sides
mt-*, mb-*, ms-*, me-*         = Margin top/bottom/start/end
p-0, p-1, p-2, p-3, p-4, p-5   = Padding all sides
pt-*, pb-*, ps-*, pe-*         = Padding top/bottom/start/end
```

### **Text Classes**
```
text-muted      = Text abu-abu
text-primary    = Text warna primary
text-danger     = Text merah
text-success    = Text hijau
text-center     = Text align center
```

### **Background Classes**
```
bg-light-primary   = Background primary terang
bg-light-danger    = Background danger terang
bg-light-success   = Background success terang
bg-light-warning   = Background warning terang
```

### **Display Classes**
```
d-none           = Display none (hide)
d-block          = Display block
d-flex           = Display flex
d-inline-block   = Display inline-block
```

### **Flex Classes**
```
d-flex                    = Enable flexbox
align-items-center        = Align items vertikal center
justify-content-between   = Space between items
flex-grow-1              = Grow untuk ambil sisa space
flex-shrink-0            = Tidak shrink
```

---

## 🛠️ Controller (TaskController.php)

### **Bulk Delete Action**

```php
public function actionBulkDelete()
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $ids = Yii::$app->request->post('ids', []);

    if (empty($ids)) {
        return [
            'success' => false,
            'message' => 'No tasks selected'
        ];
    }

    $deletedCount = Task::deleteAll(['id' => $ids]);

    Yii::$app->session->setFlash('success', "$deletedCount task(s) deleted successfully!");

    return [
        'success' => true,
        'message' => "$deletedCount task(s) deleted successfully!",
        'count' => $deletedCount
    ];
}
```

**Penjelasan**:
- `FORMAT_JSON` = Response dalam format JSON
- `Yii::$app->request->post('ids', [])` = Get POST data 'ids', default []
- `Task::deleteAll(['id' => $ids])` = Delete semua task dengan ID di array
- `setFlash()` = Set flash message untuk ditampilkan setelah reload

---

## 📝 Summary Fitur yang Diimplementasikan

### ✅ **1. Pagination**
- 5 items per page (default)
- Bisa diganti: 10, 25, 50, atau All
- Navigation: First, Previous, Next, Last

### ✅ **2. Sorting**
- Click header kolom untuk sort
- Icon visual (↕ ↑ ↓)
- Ascending/Descending toggle

### ✅ **3. Column Filters**
- **Text Search**: Title, Description, Tags
- **Dropdown**: Category, Priority, Status, Task Type, Reminder
- **Date Picker**: Deadline

### ✅ **4. Tooltips**
- Header kolom: Info "Click to sort by..."
- Badges: Info detail kategori/priority/status
- Actions: Info "Edit Task", "Delete Task"
- Auto-refresh setelah pagination

### ✅ **5. Bulk Delete**
- Select all checkbox
- Individual checkbox per row
- Delete selected button (muncul jika ada yang dipilih)
- Modal konfirmasi
- AJAX delete tanpa page refresh

### ✅ **6. Table Styling**
- Odd/even row colors
- Hover effects
- Responsive design
- Modern UI dengan template theme

---

## 🎓 Tips Belajar

1. **Inspect Element** di browser untuk lihat class yang digunakan
2. **Bootstrap Documentation**: https://getbootstrap.com/docs/5.3/
3. **DataTables Documentation**: https://datatables.net/
4. **Flatpickr Documentation**: https://flatpickr.js.org/
5. **jQuery Documentation**: https://api.jquery.com/

---

## 📌 Catatan Penting

- **jQuery** harus dimuat **sebelum** semua plugin
- **Bootstrap JS** diperlukan untuk Modal dan Tooltip
- **CSRF Token** wajib untuk POST request di Yii2
- **Tooltip** perlu reinitialize setelah table redraw
- **Checkbox** perlu event delegation untuk element dinamis

---

**Created by**: Claude AI Assistant
**Date**: 2025-11-27
**Version**: 1.0
