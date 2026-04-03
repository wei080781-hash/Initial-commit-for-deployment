# Pet Shop 專案分析報告

本專案是一個基於 **Laravel 12** 框架開發的寵物商店網站，主要用於管理與展示寵物相關產品與首頁輪播圖。

## 1. 系統架構 (Architecture)

本專案採用典型的 **MVC (Model-View-Controller)** 架構：

-   **Model (模型):** 負責資料庫交互與資料邏輯。
    -   `App\Models\User`: 使用者模型。
    -   `App\Models\Product`: 產品模型，包含名稱、價格、描述與圖片路徑。
    -   `App\Models\Carousel`: 輪播圖模型，包含圖片路徑、標題、描述與排序順序。
-   **View (視圖):** 負責前端展示，使用 Laravel 的 **Blade** 樣板引擎。
    -   `resources/views/welcome.blade.php`: 前台首頁。
    -   `resources/views/admin/`: 後台管理頁面（儀表板、輪播圖管理、產品管理）。
-   **Controller (控制器):** 負責處理請求與串接 Model 與 View。
    -   `App\Http\Controllers\Admin\ProductController`: 處理產品的增刪查改 (CRUD)。
    -   `App\Http\Controllers\Admin\CarouselController`: 處理輪播圖的增刪查改 (CRUD)。

## 2. 主要功能 (Features)

### 前台功能
-   **首頁輪播圖展示:** 自動抓取資料庫中的輪播圖資料，並依照設定的排序 (`order`) 進行展示。
-   **最新產品展示:** 首頁會自動顯示最新上架的 6 件產品資訊。

### 後台管理功能 (Admin Section)
-   **管理儀表板 (`/admin/dashboard`):** 提供後台管理的入口與概覽。
-   **輪播圖管理 (`/admin/carousels`):** 
    -   上傳新圖片並設定標題與描述。
    -   調整輪播圖顯示順序。
    -   編輯或刪除現有的輪播圖。
-   **產品管理 (`/admin/products`):**
    -   管理寵物產品資訊（名稱、價格、描述、圖片）。
    -   完整的產品 CRUD 功能。

## 3. 技術棧 (Tech Stack)
-   **後端框架:** Laravel 12
-   **程式語言:** PHP 8.2+
-   **前端工具:** Vite (用於編譯 JavaScript 與 CSS)
-   **資料庫:** 支援 MySQL 或 SQLite (由遷移檔案定義)
-   **樣板引擎:** Blade

## 4. 未來擴展計畫 (Future Expansion)

### 會員登入系統 (Member Auth System)
-   **架構設計:** 採用 **API 驅動架構 (API-Driven Architecture)**，實現前後端分離的擴展性。
-   **預計功能:**
    -   **身分驗證 API:** 提供註冊 (Register)、登入 (Login)、登出 (Logout) 等 RESTful 介面。
    -   **安全性:** 使用 **Laravel Sanctum** 或 **JWT (JSON Web Token)** 進行無狀態 (Stateless) 的請求驗證。
    -   **個人資料管理:** 提供 API 查詢與更新會員基本資料。
-   **串接方式:** 未來前端 (如 Vue.js, React 或 Mobile App) 可透過 AJAX/Axios 異步調用後端 API，提升使用者體驗與系統靈活性。

---
*此報告由 Gemini CLI 自動生成。*
