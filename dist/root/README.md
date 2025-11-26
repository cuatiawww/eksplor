# Ruang Yosua - Personal Task & Notes Manager

**Ruang Yosua** adalah aplikasi personal task management dan daily journal sederhana yang dibuat menggunakan template admin Flatable. Dibuat untuk belajar web development dengan konsep CRUD dan database yang mudah.

## 🎯 Konsep Aplikasi

Aplikasi ini berfungsi untuk:
- ✅ **Mengelola To-Do List**: Tambah, edit, hapus, dan tandai task sebagai selesai
- 📝 **Menulis Daily Notes**: Catatan harian/jurnal dengan mood tracker dan tags
- 📊 **Dashboard**: Monitoring progress task dan streak harian

---

## 📁 Struktur File

```
root/
├── index.html          # Dashboard utama dengan statistik
├── todo-list.html      # Halaman To-Do List untuk manage tasks
├── daily-notes.html    # Halaman Daily Notes untuk jurnal harian
├── custom-theme.css    # Custom orange theme colors
├── components/
│   ├── sidebar.html    # Reusable sidebar component
│   ├── header.html     # Reusable header component
│   └── load-components.js  # JavaScript component loader
├── login.html          # (Opsional - untuk development)
├── register.html       # (Opsional - untuk development)
└── README.md           # File ini
```

---

## 🚀 Fitur Utama

### 1. **Dashboard ([index.html](index.html))**
- **Welcome Card**: Greeting dan intro singkat
- **Statistik Cards**:
  - 📋 Total Tasks
  - ✅ Completed Tasks
  - 📝 Total Notes
  - 🔥 Streak Days
- **Quick Actions**: Tombol cepat ke To-Do List dan Daily Notes
- **Sidebar & Navbar**: Navigasi responsive dengan dark/light mode

### 2. **To-Do List ([todo-list.html](todo-list.html))**
- **Add New Task**:
  - Input task dengan judul
  - Priority level (Low, Medium, High)
  - Add task button
- **Pending Tasks**:
  - Checkbox untuk mark as done
  - Badge priority (Low/Medium/High)
  - Tanggal deadline
  - Edit & Delete buttons
- **Completed Tasks**:
  - List task yang sudah selesai
  - Text strikethrough
  - Badge "Completed"

### 3. **Daily Notes ([daily-notes.html](daily-notes.html))**
- **Write Note Form**:
  - Judul (optional)
  - Tanggal
  - **Mood Selector**: 😄 Sangat Senang, 😊 Senang, 😐 Biasa, 😢 Sedih, dll
  - Cerita harian (textarea besar)
  - Tags (comma-separated)
- **Recent Notes**:
  - Card grid dengan preview notes
  - Mood emoji badge
  - Tags dengan warna berbeda
  - Edit & Delete buttons
  - Filter: All, This Week, This Month

---

## 🗄️ Database Schema (Untuk Backend Nanti)

### Tabel: **tasks**
```sql
CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    deadline DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tabel: **notes**
```sql
CREATE TABLE notes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    content TEXT NOT NULL,
    note_date DATE NOT NULL,
    mood VARCHAR(50),
    tags VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tabel: **users** (Opsional untuk multi-user)
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 💡 Cara Menggunakan

### 1. **Buka Aplikasi**
- Langsung buka [index.html](index.html) di browser
- Tidak perlu server, pure frontend untuk belajar

### 2. **Navigasi**
- Gunakan **sidebar menu** di sebelah kiri:
  - 📊 Dashboard
  - ✅ To-Do List
  - 📝 Daily Notes
- Klik menu untuk berpindah halaman

### 3. **Testing Fitur**
- **To-Do List**: Coba add task, tandai sebagai completed
- **Daily Notes**: Tulis note dengan mood dan tags
- **Dashboard**: Lihat statistik (data masih dummy/static)

### 4. **Theme Switcher**
- Klik icon **matahari** di header (kanan atas)
- Pilih Dark atau Light mode

---

## 🛠️ Template & Assets

Menggunakan **Flatable Admin Template** dengan:
- **CSS Framework**: Bootstrap 5
- **Icons**: Phosphor Duotone (`ph-duotone`)
- **JavaScript**: Bootstrap JS, Feather icons, pcoded.js
- **Assets Path**: `../assets/` (relative path)

---

## 📝 Catatan Teknis

### 🎨 Custom Theme - Orange Warm Tones

Aplikasi ini menggunakan **custom-theme.css** dengan skema warna orange hangat:

**Color Variables:**
```css
:root {
  --primary-color: #D2691E;      /* Orange Tua Kecoklatan */
  --secondary-color: #FF6B35;    /* Orange Api */
  --bg-main: #FFF8F3;            /* Putih ke-Orange-an */
  --bg-sidebar: #2C1810;         /* Coklat Gelap */
}
```

Theme ini diterapkan secara konsisten di semua halaman (index, todo-list, daily-notes) untuk memberikan tampilan yang kohesif dan hangat.

### 🧩 Reusable Components

Aplikasi menggunakan **component-based architecture** untuk menghindari duplikasi kode:

**Komponen yang dibuat:**
- `components/sidebar.html` - Sidebar navigation menu
- `components/header.html` - Top header bar dengan theme switcher dan profile popup
- `components/load-components.js` - JavaScript untuk load components secara dinamis

**Cara Kerja:**
```html
<!-- Di setiap halaman HTML, sidebar dan header diganti dengan: -->
<div id="sidebar-container"></div>
<div id="header-container"></div>

<!-- JavaScript akan load component secara otomatis -->
<script src="components/load-components.js"></script>
```

**Keuntungan:**
- ✅ **DRY (Don't Repeat Yourself)**: Edit sidebar/header di satu tempat saja
- ✅ **Konsisten**: Semua halaman punya sidebar dan header yang sama
- ✅ **Mudah Maintenance**: Update menu atau header cukup di satu file

**Active Menu Detection:**
Component loader secara otomatis mendeteksi halaman aktif dan memberi class `active` pada menu yang sesuai berdasarkan attribute `data-page`.

### Struktur HTML:
```html
<body>
  <!-- Sidebar Component Container -->
  <div id="sidebar-container"></div>

  <!-- Header Component Container -->
  <div id="header-container"></div>

  <!-- Main Content -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- Your content here -->
    </div>
  </div>

  <!-- Component Loader -->
  <script src="components/load-components.js"></script>
</body>
```

### Class Penting:
- `pc-sidebar`: Sidebar menu
- `pc-header`: Top navbar
- `pc-container` > `pc-content`: Main content wrapper
- `card`: Bootstrap card component
- `btn btn-primary`: Button styling (orange theme)
- `badge bg-light-success`: Badge/label
- `data-page`: Attribute untuk active menu detection

---

## 🎓 Next Steps - Integrasi Backend

Setelah paham struktur HTML, langkah selanjutnya:

### 1. **Setup Backend (PHP/Node.js/Python)**
```
root/
├── backend/
│   ├── api/
│   │   ├── tasks.php       # CRUD tasks
│   │   ├── notes.php       # CRUD notes
│   │   └── config.php      # Database connection
│   └── index.php
└── dist/root/              # Frontend files
```

### 2. **Database Connection**
- Buat database MySQL: `ruang_yosua`
- Import tabel tasks dan notes (SQL schema di atas)
- Koneksi dari backend ke database

### 3. **CRUD Operations**
- **Create**: POST form data ke API
- **Read**: GET data dari API, render di frontend
- **Update**: PUT/PATCH untuk edit data
- **Delete**: DELETE untuk hapus data

### 4. **JavaScript Integration**
```javascript
// Contoh: Add task dengan AJAX
document.querySelector('form').addEventListener('submit', async (e) => {
  e.preventDefault();
  const formData = new FormData(e.target);

  const response = await fetch('/api/tasks.php', {
    method: 'POST',
    body: formData
  });

  const result = await response.json();
  // Update UI
});
```

---

## 🎨 Customization

### Ubah Nama:
- Ganti "Yosua" di [components/sidebar.html](components/sidebar.html)
- Edit di [components/header.html](components/header.html) untuk profile popup
- Karena menggunakan components, cukup edit di 2 file tersebut dan akan update semua halaman!

### Tambah Menu:
Edit file [components/sidebar.html](components/sidebar.html):
```html
<li class="pc-item" data-page="new-page">
  <a href="new-page.html" class="pc-link">
    <span class="pc-micon">
      <i class="ph-duotone ph-icon-name"></i>
    </span>
    <span class="pc-mtext">Menu Baru</span>
  </a>
</li>
```
**Jangan lupa tambahkan `data-page` attribute untuk active menu detection!**

### Ubah Warna Theme:
Edit file [custom-theme.css](custom-theme.css) di bagian `:root`:
```css
:root {
  --primary-color: #D2691E;      /* Ganti dengan warna primary pilihan kamu */
  --secondary-color: #FF6B35;    /* Ganti dengan warna secondary pilihan kamu */
  --bg-main: #FFF8F3;            /* Background utama */
  --bg-sidebar: #2C1810;         /* Background sidebar */
}
```
Semua halaman akan otomatis update dengan warna baru!

---

## 📚 Resources

- **Template**: [Flatable Dashboard](https://html.phoenixcoded.net/flatable/)
- **Icons**: [Phosphor Icons](https://phosphoricons.com/)
- **Bootstrap**: [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.0/)

---

## ✨ Credits

**Dibuat oleh**: Yosua
**Template**: Flatable by PhoenixCoded
**Purpose**: Learning project - Personal Task & Notes Manager

---

**Selamat Belajar & Happy Coding!** 🚀📝
