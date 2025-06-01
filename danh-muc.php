<?php

include 'config/database.php';
include 'config/category_mapping.php';

// Lấy category từ URL
$category_slug = $_GET['cat'] ?? 'thuoc-khong-ke-don';
$category_id = get_category_id($category_slug);

// Lấy thông tin danh mục
$category_sql = "SELECT * FROM danh_muc_thuoc WHERE ma_danh_muc = ? AND trang_thai_hoat_dong = TRUE";
$category_stmt = $conn->prepare($category_sql);
$category_stmt->bind_param("i", $category_id);
$category_stmt->execute();
$category_result = $category_stmt->get_result();
$category_info = $category_result->fetch_assoc();

// Nếu không tìm thấy danh mục
if (!$category_info) {
    $category_info = [
        'ten_danh_muc' => 'Danh mục sản phẩm',
        'mo_ta' => 'Khám phá các sản phẩm chất lượng cao'
    ];
}

// Lấy sản phẩm
$products_sql = "
    SELECT 
        sp.ma_san_pham,
        sp.ten_san_pham,
        sp.gia_ban,
        sp.gia_khuyen_mai,
        sp.mo_ta,
        sp.can_don_thuoc,
        sp.san_pham_noi_bat,
        sp.ngay_tao,
        nsx.ten_nha_san_xuat,
        ha.duong_dan_hinh_anh
    FROM san_pham_thuoc sp
    LEFT JOIN nha_san_xuat nsx ON sp.ma_nha_san_xuat = nsx.ma_nha_san_xuat
    LEFT JOIN hinh_anh_san_pham ha ON sp.ma_san_pham = ha.ma_san_pham AND ha.la_hinh_chinh = TRUE
    WHERE sp.ma_danh_muc = ? AND sp.trang_thai_hoat_dong = TRUE
    ORDER BY sp.san_pham_noi_bat DESC, sp.ngay_tao DESC
";

$products_stmt = $conn->prepare($products_sql);
$products_stmt->bind_param("i", $category_id);
$products_stmt->execute();
$products_result = $products_stmt->get_result();

$products = [];
while ($row = $products_result->fetch_assoc()) {
    $products[] = $row;
}

// Debug: Hiển thị số sản phẩm tìm được
echo "<!-- Debug: Category ID = $category_id, Found " . count($products) . " products -->";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Danh Mục Sản Phẩm - VitaMeds</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/danh-muc.css">
  
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-top">
                <a href="index.php" class="logo">
                    <img src="./images/medical-care-logo-illustration-vector.jpg" alt="VitaMeds Logo">
                    <span>VitaMeds</span>
                </a>
                
                <div class="search-container">
                    <input type="text" class="search-box" placeholder="Nhập loại thuốc cần tìm...">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <div class="header-actions">
                    <a href="cart.html" class="cart-btn">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Giỏ hàng</span>
                        <span class="cart-count">0</span>
                    </a>
                    <a href="login.php" class="login-btn">
                        <i class="fas fa-user"></i>
                        <span>Đăng nhập</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="nav-menu">
        <div class="container">
            <div class="nav-items">
                <a href="?cat=thuoc-khong-ke-don" class="nav-item" data-category="thuoc-khong-ke-don">Thuốc không kê đơn</a>
                <a href="?cat=thuoc-ke-don" class="nav-item" data-category="thuoc-ke-don">Thuốc kê đơn</a>
                <a href="?cat=vitamin-khoang-chat" class="nav-item" data-category="vitamin-khoang-chat">Vitamin & Khoáng chất</a>
                <a href="?cat=thuc-pham-chuc-nang" class="nav-item" data-category="thuc-pham-chuc-nang">Thực phẩm chức năng</a>
                <a href="?cat=duoc-my-pham" class="nav-item" data-category="duoc-my-pham">Dược mỹ phẩm</a>
                <a href="?cat=thiet-bi-y-te" class="nav-item" data-category="thiet-bi-y-te">Thiết bị y tế</a>
                <a href="?cat=me-va-be" class="nav-item" data-category="me-va-be">Mẹ & bé</a>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="breadcrumb-list">
                <li><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li class="current" id="breadcrumb-current">Danh mục sản phẩm</li>
            </ul>
        </div>
    </div>

    <!-- Category Header -->
    <section class="category-header">
        <div class="container">
            <h1 id="category-title">Danh Mục Sản Phẩm</h1>
            <p id="category-description">Khám phá các sản phẩm chất lượng cao</p>
            <div class="category-stats">
                <div class="stat-item">
                    <span class="stat-number" id="total-products">150+</span>
                    <span class="stat-label">Sản phẩm</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">10+</span>
                    <span class="stat-label">Thương hiệu</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">5★</span>
                    <span class="stat-label">Đánh giá</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="container">
            <div class="filter-container">
                <div class="filter-left">
                    <div class="filter-group">
                        <label>Sắp xếp:</label>
                        <select class="filter-select" id="sort-select">
                            <option value="default">Mặc định</option>
                            <option value="name-asc">Tên A-Z</option>
                            <option value="name-desc">Tên Z-A</option>
                            <option value="price-asc">Giá thấp - cao</option>
                            <option value="price-desc">Giá cao - thấp</option>
                            <option value="newest">Mới nhất</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Giá:</label>
                        <select class="filter-select" id="price-filter">
                            <option value="all">Tất cả</option>
                            <option value="0-50000">Dưới 50.000đ</option>
                            <option value="50000-200000">50.000đ - 200.000đ</option>
                            <option value="200000-500000">200.000đ - 500.000đ</option>
                            <option value="500000+">Trên 500.000đ</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Thương hiệu:</label>
                        <select class="filter-select" id="brand-filter">
                            <option value="all">Tất cả</option>
                            <option value="teva">Teva</option>
                            <option value="sanofi">Sanofi</option>
                            <option value="pfizer">Pfizer</option>
                            <option value="hau-giang">Hậu Giang</option>
                        </select>
                    </div>
                </div>
                <div class="view-toggle">
                    <button class="view-btn active" onclick="switchView('grid')">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-btn" onclick="switchView('list')">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <!-- Loading Spinner -->
            <div class="loading-spinner" id="loading-spinner">
                <div class="spinner"></div>
                <p>Đang tải sản phẩm...</p>
            </div>

            <!-- Grid View -->
            <!-- Grid View -->
<div class="products-grid active" id="products-grid">
    <?php if (empty($products)): ?>
        <div style="grid-column: 1/-1; text-align: center; padding: 60px;">
            <h3>Không có sản phẩm nào</h3>
            <p>Danh mục này hiện tại chưa có sản phẩm.</p>
        </div>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <?php 
                // Tính badge
                if ($product['can_don_thuoc']) {
                    echo '<div class="product-badge prescription">Kê đơn</div>';
                } elseif ($product['gia_khuyen_mai'] && $product['gia_khuyen_mai'] < $product['gia_ban']) {
                    $discount = round((($product['gia_ban'] - $product['gia_khuyen_mai']) / $product['gia_ban']) * 100);
                    echo '<div class="product-badge">Giảm ' . $discount . '%</div>';
                } elseif ($product['san_pham_noi_bat']) {
                    echo '<div class="product-badge">Nổi bật</div>';
                }
                ?>
                
                <div class="product-image">
                    <img src="<?php echo $product['duong_dan_hinh_anh'] ?: 'https://via.placeholder.com/150x150?text=' . urlencode($product['ten_san_pham']); ?>" 
                         alt="<?php echo htmlspecialchars($product['ten_san_pham']); ?>">
                </div>
                
                <h3><?php echo htmlspecialchars($product['ten_san_pham']); ?></h3>
                <div class="product-manufacturer"><?php echo htmlspecialchars($product['ten_nha_san_xuat'] ?: 'Không rõ'); ?></div>
                
                <div class="product-price">
                    <span class="current-price">
                        <?php echo number_format($product['gia_khuyen_mai'] ?: $product['gia_ban'], 0, ',', '.'); ?>đ
                    </span>
                    <?php if ($product['gia_khuyen_mai'] && $product['gia_khuyen_mai'] < $product['gia_ban']): ?>
                        <span class="old-price"><?php echo number_format($product['gia_ban'], 0, ',', '.'); ?>đ</span>
                    <?php endif; ?>
                </div>
                
                <div class="product-actions">
                    <button class="add-to-cart">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                    <button class="quick-view">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

            <!-- List View -->
            <div class="products-list" id="products-list">
                <!-- Products will be loaded here by JavaScript -->
            </div>

            <!-- Pagination -->
            <div class="pagination" id="pagination">
                <a href="#" class="page-btn disabled" id="prev-btn">
                    <i class="fas fa-chevron-left"></i> Trước
                </a>
                <a href="#" class="page-btn active">1</a>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn">3</a>
                <a href="#" class="page-btn">...</a>
                <a href="#" class="page-btn">10</a>
                <a href="#" class="page-btn" id="next-btn">
                    Sau <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </section>
    <script>
        // Category data
        const categoryData = {
            'thuoc-khong-ke-don': {
                title: 'Thuốc Không Kê Đơn',
                description: 'Các loại thuốc thông dụng có thể mua không cần đơn thuốc',
                products: [
                    {
                        id: 1,
                        name: 'Paracetamol 500mg',
                        manufacturer: 'Teva',
                        price: 25000,
                        oldPrice: 30000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Paracetamol',
                        badge: 'Giảm 15%',
                        description: 'Thuốc giảm đau, hạ sốt hiệu quả cho người lớn và trẻ em'
                    },
                    {
                        id: 2,
                        name: 'Aspirin 100mg',
                        manufacturer: 'Sanofi',
                        price: 35000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Aspirin',
                        badge: 'Hot',
                        description: 'Thuốc chống đông máu, phòng ngừa đột quỵ và nhồi máu cơ tim'
                    },
                    {
                        id: 3,
                        name: 'Ibuprofen 400mg',
                        manufacturer: 'Pfizer',
                        price: 45000,
                        oldPrice: 55000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Ibuprofen',
                        badge: 'Giảm 18%',
                        description: 'Thuốc chống viêm, giảm đau và hạ sốt mạnh'
                    }
                ]
            },
            'thuoc-ke-don': {
                title: 'Thuốc Kê Đơn',
                description: 'Thuốc cần có đơn thuốc của bác sĩ để mua',
                products: [
                    {
                        id: 4,
                        name: 'Amoxicillin 500mg',
                        manufacturer: 'Hậu Giang',
                        price: 85000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Amoxicillin',
                        badge: 'Kê đơn',
                        badgeType: 'prescription',
                        description: 'Kháng sinh điều trị nhiễm khuẩn đường hô hấp'
                    },
                    {
                        id: 5,
                        name: 'Metformin 500mg',
                        manufacturer: 'Teva',
                        price: 120000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Metformin',
                        badge: 'Kê đơn',
                        badgeType: 'prescription',
                        description: 'Thuốc điều trị tiểu đường type 2'
                    }
                ]
            },
            'vitamin-khoang-chat': {
                title: 'Vitamin & Khoáng Chất',
                description: 'Bổ sung vitamin và khoáng chất thiết yếu cho cơ thể',
                products: [
                    {
                        id: 6,
                        name: 'Vitamin C 1000mg',
                        manufacturer: 'Sanofi',
                        price: 120000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Vitamin+C',
                        badge: 'Bán chạy',
                        description: 'Tăng cường miễn dịch, chống oxy hóa'
                    },
                    {
                        id: 7,
                        name: 'Calcium + D3',
                        manufacturer: 'Pfizer',
                        price: 95000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Calcium+D3',
                        badge: 'Mới',
                        badgeType: 'new',
                        description: 'Bổ sung canxi và vitamin D3 cho xương chắc khỏe'
                    },
                    {
                        id: 8,
                        name: 'Omega-3 Fish Oil',
                        manufacturer: 'Teva',
                        price: 180000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Omega-3',
                        description: 'Hỗ trợ tim mạch và não bộ khỏe mạnh'
                    }
                ]
            },
            'thuc-pham-chuc-nang': {
                title: 'Thực Phẩm Chức Năng',
                description: 'Sản phẩm hỗ trợ sức khỏe và dinh dưỡng',
                products: [
                    {
                        id: 9,
                        name: 'Glucosamine 1500mg',
                        manufacturer: 'Sanofi',
                        price: 320000,
                        oldPrice: 355000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Glucosamine',
                        badge: 'Giảm 10%',
                        description: 'Hỗ trợ xương khớp, giảm đau khớp'
                    }
                ]
            },
            'duoc-my-pham': {
                title: 'Dược Mỹ Phẩm',
                description: 'Sản phẩm chăm sóc da và làm đẹp',
                products: [
                    {
                        id: 10,
                        name: 'Kem dưỡng da La Roche',
                        manufacturer: 'La Roche Posay',
                        price: 450000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=La+Roche',
                        badge: 'Premium',
                        description: 'Kem dưỡng ẩm cho da nhạy cảm'
                    },
                    {
                        id: 11,
                        name: 'Serum Vitamin C',
                        manufacturer: 'Eucerin',
                        price: 380000,
                        oldPrice: 420000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Serum',
                        badge: 'Giảm 10%',
                        description: 'Serum làm sáng da, chống lão hóa'
                    }
                ]
            },
            'thiet-bi-y-te': {
                title: 'Thiết Bị Y Tế',
                description: 'Các thiết bị y tế gia đình và chuyên nghiệp',
                products: [
                    {
                        id: 12,
                        name: 'Máy đo huyết áp Omron',
                        manufacturer: 'Omron',
                        price: 850000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Omron',
                        badge: 'Bán chạy',
                        description: 'Máy đo huyết áp tự động, chính xác cao'
                    },
                    {
                        id: 13,
                        name: 'Nhiệt kế điện tử',
                        manufacturer: 'Microlife',
                        price: 120000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Thermometer',
                        badge: 'Mới',
                        badgeType: 'new',
                        description: 'Nhiệt kế đo trán không tiếp xúc'
                    }
                ]
            },
            'me-va-be': {
                title: 'Mẹ & Bé',
                description: 'Sản phẩm chăm sóc cho mẹ và bé yêu',
                products: [
                    {
                        id: 14,
                        name: 'Sữa bột Enfamil A+',
                        manufacturer: 'Mead Johnson',
                        price: 650000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Enfamil',
                        badge: 'Tin cậy',
                        description: 'Sữa bột công thức cho trẻ 0-6 tháng'
                    },
                    {
                        id: 15,
                        name: 'Tã Pampers Premium',
                        manufacturer: 'Pampers',
                        price: 320000,
                        oldPrice: 350000,
                        image: 'https://via.placeholder.com/150x150/ffffff/333333?text=Pampers',
                        badge: 'Giảm 8%',
                        description: 'Tã cao cấp siêu thấm hút, êm ái'
                    }
                ]
            }
        };

        let currentCategory = 'thuoc-khong-ke-don';
        let currentPage = 1;
        const productsPerPage = 9;

        // Initialize page
        // Xóa mọi element floating bị lỗi
document.addEventListener('DOMContentLoaded', function() {
    // Xóa các element cố định ở góc phải
    setInterval(() => {
        const floatingElements = document.querySelectorAll('[style*="position: fixed"][style*="right: 20px"]');
        floatingElements.forEach(el => {
            if (!el.classList.contains('toast')) {
                el.remove();
            }
        });
    }, 1000);
});

        function setActiveNavigation() {
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('data-category') === currentCategory) {
                    item.classList.add('active');
                }
            });
        }

        function loadCategory(categoryKey) {
            const category = categoryData[categoryKey];
            if (!category) return;

            // Update page title and meta
            document.getElementById('page-title').textContent = `${category.title} - VitaMeds`;
            document.getElementById('category-title').textContent = category.title;
            document.getElementById('category-description').textContent = category.description;
            document.getElementById('breadcrumb-current').textContent = category.title;
            document.getElementById('total-products').textContent = `${category.products.length}+`;

            // Show loading
            showLoading();

            // Simulate loading delay
            setTimeout(() => {
                hideLoading();
                renderProducts(category.products);
            }, 800);
        }

        function renderProducts(products) {
            renderGridView(products);
            renderListView(products);
        }

        function renderGridView(products) {
            const gridContainer = document.getElementById('products-grid');
            gridContainer.innerHTML = '';

            products.forEach(product => {
                const productCard = createProductCard(product);
                gridContainer.appendChild(productCard);
            });
        }

        function renderListView(products) {
            const listContainer = document.getElementById('products-list');
            listContainer.innerHTML = '';

            products.forEach(product => {
                const productItem = createProductListItem(product);
                listContainer.appendChild(productItem);
            });
        }

        function createProductCard(product) {
            const card = document.createElement('div');
            card.className = 'product-card';
            card.onclick = () => goToProductDetail(product.id);

            const badgeClass = product.badgeType === 'prescription' ? 'prescription' : 
                              product.badgeType === 'new' ? 'new' : '';

            card.innerHTML = `
                ${product.badge ? `<div class="product-badge ${badgeClass}">${product.badge}</div>` : ''}
                <div class="product-image">
                    <img src="${product.image}" alt="${product.name}">
                </div>
                <h3>${product.name}</h3>
                <div class="product-manufacturer">${product.manufacturer}</div>
                <div class="product-price">
                    <span class="current-price">${formatPrice(product.price)}</span>
                    ${product.oldPrice ? `<span class="old-price">${formatPrice(product.oldPrice)}</span>` : ''}
                </div>
                <div class="product-actions">
                    <button class="add-to-cart" onclick="event.stopPropagation(); addToCart(${product.id})">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                    <button class="quick-view" onclick="event.stopPropagation(); quickView(${product.id})">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            `;

            return card;
        }

        function createProductListItem(product) {
            const item = document.createElement('div');
            item.className = 'product-list-item';
            item.onclick = () => goToProductDetail(product.id);

            const badgeClass = product.badgeType === 'prescription' ? 'prescription' : 
                              product.badgeType === 'new' ? 'new' : '';

            item.innerHTML = `
                <div class="list-product-image">
                    <img src="${product.image}" alt="${product.name}">
                </div>
                <div class="list-product-info">
                    <h3>${product.name} 
                        ${product.badge ? `<span class="product-badge ${badgeClass}">${product.badge}</span>` : ''}
                    </h3>
                    <div class="product-manufacturer">${product.manufacturer}</div>
                    <div class="list-product-description">${product.description}</div>
                    <div class="list-product-actions">
                        <div class="product-price">
                            <span class="current-price">${formatPrice(product.price)}</span>
                            ${product.oldPrice ? `<span class="old-price">${formatPrice(product.oldPrice)}</span>` : ''}
                        </div>
                        <button class="add-to-cart" onclick="event.stopPropagation(); addToCart(${product.id})">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            `;

            return item;
        }

        function formatPrice(price) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(price);
        }

        function switchView(viewType) {
            const gridView = document.getElementById('products-grid');
            const listView = document.getElementById('products-list');
            const viewBtns = document.querySelectorAll('.view-btn');

            viewBtns.forEach(btn => btn.classList.remove('active'));

            if (viewType === 'grid') {
                gridView.classList.add('active');
                listView.classList.remove('active');
                viewBtns[0].classList.add('active');
            } else {
                gridView.classList.remove('active');
                listView.classList.add('active');
                viewBtns[1].classList.add('active');
            }
        }

        function showLoading() {
            document.getElementById('loading-spinner').style.display = 'block';
            document.getElementById('products-grid').style.display = 'none';
            document.getElementById('products-list').style.display = 'none';
        }

        function hideLoading() {
            document.getElementById('loading-spinner').style.display = 'none';
            document.getElementById('products-grid').style.display = 'grid';
            document.getElementById('products-list').style.display = 'block';
        }

        function addEventListeners() {
            // Sort and filter events
            document.getElementById('sort-select').addEventListener('change', handleSort);
            document.getElementById('price-filter').addEventListener('change', handlePriceFilter);
            document.getElementById('brand-filter').addEventListener('change', handleBrandFilter);

            // Navigation events
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const category = this.getAttribute('data-category');
                    if (category !== currentCategory) {
                        currentCategory = category;
                        setActiveNavigation();
                        loadCategory(category);
                        
                        // Update URL
                        const url = new URL(window.location);
                        url.searchParams.set('cat', category);
                        window.history.pushState({}, '', url);
                    }
                });
            });
        }

        function handleSort(e) {
            const sortValue = e.target.value;
            const category = categoryData[currentCategory];
            let sortedProducts = [...category.products];

            switch(sortValue) {
                case 'name-asc':
                    sortedProducts.sort((a, b) => a.name.localeCompare(b.name));
                    break;
                case 'name-desc':
                    sortedProducts.sort((a, b) => b.name.localeCompare(a.name));
                    break;
                case 'price-asc':
                    sortedProducts.sort((a, b) => a.price - b.price);
                    break;
                case 'price-desc':
                    sortedProducts.sort((a, b) => b.price - a.price);
                    break;
                case 'newest':
                    sortedProducts.sort((a, b) => b.id - a.id);
                    break;
                default:
                    // Keep original order
                    break;
            }

            renderProducts(sortedProducts);
        }

        function handlePriceFilter(e) {
            const priceRange = e.target.value;
            const category = categoryData[currentCategory];
            let filteredProducts = [...category.products];

            if (priceRange !== 'all') {
                if (priceRange === '500000+') {
                    filteredProducts = filteredProducts.filter(p => p.price >= 500000);
                } else {
                    const [min, max] = priceRange.split('-').map(Number);
                    filteredProducts = filteredProducts.filter(p => p.price >= min && p.price <= max);
                }
            }

            renderProducts(filteredProducts);
        }

        function handleBrandFilter(e) {
            const brand = e.target.value;
            const category = categoryData[currentCategory];
            let filteredProducts = [...category.products];

            if (brand !== 'all') {
                filteredProducts = filteredProducts.filter(p => 
                    p.manufacturer.toLowerCase().includes(brand.toLowerCase())
                );
            }

            renderProducts(filteredProducts);
        }

        // Product actions
        function addToCart(productId) {
            // Find product
            const allProducts = Object.values(categoryData).flatMap(cat => cat.products);
            const product = allProducts.find(p => p.id === productId);
            
            if (product) {
                // Get current cart count
                let cartCount = parseInt(document.querySelector('.cart-count').textContent) || 0;
                cartCount++;
                document.querySelector('.cart-count').textContent = cartCount;

                // Show success message
                showToast(`Đã thêm "${product.name}" vào giỏ hàng!`, 'success');
            }
        }

        function quickView(productId) {
            showToast('Tính năng xem nhanh đang được phát triển!', 'info');
        }

        function goToProductDetail(productId) {
            // Redirect to product detail page
            window.location.href = `product-detail.html?id=${productId}`;
        }

        // Toast notification
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#27ae60' : '#3498db'};
                color: white;
                padding: 15px 20px;
                border-radius: 5px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                z-index: 10000;
                animation: slideInRight 0.3s ease;
            `;
            toast.textContent = message;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Add toast animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>