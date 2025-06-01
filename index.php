<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaMeds - Hiệu Thuốc Trực Tuyến Uy Tín</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-top">
                <div class="logo">
                    <a href="index.php"><img src="./images/medical-care-logo-illustration-vector.jpg" alt="VitaMeds Logo"></a>
                    <span>VitaMeds</span>
                </div>
                
                <div class="search-container">
                    <input type="text" class="search-box" placeholder="Nhập loại thuốc cần tìm...">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <div class="header-actions">
                    <a href="#" class="cart-btn">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Giỏ hàng</span>
                        <span class="cart-count">0</span>
                    </a>
                    <a href="./login.php" class="login-btn">
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
                <a href="./danh-muc.php?cat=thuoc-khong-ke-don" class="nav-item">Thuốc không kê đơn</a>
                <a href="./danh-muc.php?cat=thuoc-ke-don" class="nav-item">Thuốc kê đơn</a>
                <a href="./danh-muc.php?cat=vitamin-khoang-chat" class="nav-item">Vitamin & Khoáng chất</a>
                <a href="./danh-muc.php?cat=thuc-pham-chuc-nang" class="nav-item">Thực phẩm chức năng</a>
                <a href="./danh-muc.php?cat=duoc-my-pham" class="nav-item">Dược mỹ phẩm</a>
                <a href="./danh-muc.php?cat=thiet-bi-y-te" class="nav-item">Thiết bị y tế</a>
                <a href="./danh-muc.php?cat=me-va-be" class="nav-item">Mẹ & bé</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="banner-slider">
                <div class="main-banner">
                    <div class="banner-content">
                        <h2>Khỏe Mạnh Mỗi Ngày</h2>
                        <p>Hàng nghìn sản phẩm chính hãng với giá tốt nhất. Giao hàng nhanh chóng toàn quốc.</p>
                        <!-- <button class="cta-button">Mua Ngay</button> -->
                    </div>
                </div>
                
                <div class="side-banner">
                    <h3>Giảm giá lớn</h3>
                    <div class="discount">30%</div>
                    <p>Cho đơn hàng đầu tiên</p>
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="trust-badges">
                <div class="trust-item">
                    <i class="fas fa-certificate"></i>
                    <h4>Chính hãng 100%</h4>
                    <p>Cam kết thuốc chính hãng, có nguồn gốc xuất xứ rõ ràng</p>
                </div>
                <div class="trust-item">
                    <i class="fas fa-shipping-fast"></i>
                    <h4>Giao hàng nhanh</h4>
                    <p>Giao hàng trong 2-4 giờ tại TP.HCM và 1-2 ngày toàn quốc</p>
                </div>
                <div class="trust-item">
                    <i class="fas fa-user-md"></i>
                    <h4>Tư vấn dược sĩ</h4>
                    <p>Đội ngũ dược sĩ tư vấn 24/7, hỗ trợ khách hàng mọi lúc</p>
                </div>
                <div class="trust-item">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Thanh toán an toàn</h4>
                    <p>Bảo mật thông tin thanh toán với công nghệ mã hóa SSL</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products">
        <div class="container">
            <div class="section-title">
                <h2>Sản Phẩm Nổi Bật</h2>
                <p>Những sản phẩm được khách hàng tin tưởng và lựa chọn nhiều nhất</p>
            </div>
            
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-badge">-15%</div>
                    <div class="product-image">
                        <img src="./images/OIP.jpg" alt="Paracetamol 500mg">
                    </div>
                    <h3>Paracetamol 500mg</h3>
                    <div class="product-price">
                        <span class="current-price">25.000đ</span>
                        <span class="old-price">30.000đ</span>
                    </div>
                    <button class="add-to-cart">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                </div>

                <div class="product-card">
                    <div class="product-badge">Hot</div>
                    <div class="product-image">
                        <img src="./images/download.jpg" alt="Vitamin C 1000mg">
                    </div>
                    <h3>Vitamin C 1000mg</h3>
                    <div class="product-price">
                        <span class="current-price">120.000đ</span>
                    </div>
                    <button class="add-to-cart">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                </div>

                <div class="product-card">
                    <div class="product-badge">-20%</div>
                    <div class="product-image">
                        <img src="./images/OIP (1).jpg" alt="Amoxicillin 250mg">
                    </div>
                    <h3>Amoxicillin 250mg</h3>
                    <div class="product-price">
                        <span class="current-price">45.000đ</span>
                        <span class="old-price">56.000đ</span>
                    </div>
                    <button class="add-to-cart">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="./images/OIP (2).jpg" alt="Omega-3 Fish Oil">
                    </div>
                    <h3>Omega-3 Fish Oil</h3>
                    <div class="product-price">
                        <span class="current-price">180.000đ</span>
                    </div>
                    <button class="add-to-cart">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                </div>

                <div class="product-card">
                    <div class="product-badge">Mới</div>
                    <div class="product-image">
                        <img src="./images/OIP (3).jpg" alt="Calcium + D3">
                    </div>
                    <h3>Calcium + D3</h3>
                    <div class="product-price">
                        <span class="current-price">95.000đ</span>
                    </div>
                    <button class="add-to-cart">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                </div>

                <div class="product-card">
                    <div class="product-badge">-10%</div>
                    <div class="product-image">
                        <img src="./images/OIP (4).jpg" alt="Glucosamine 1500mg">
                    </div>
                    <h3>Glucosamine 1500mg</h3>
                    <div class="product-price">
                        <span class="current-price">320.000đ</span>
                        <span class="old-price">355.000đ</span>
                    </div>
                    <button class="add-to-cart">
                        <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="categories-section">
        <div class="container">
            <div class="section-title">
                <h2>Danh Mục Sản Phẩm</h2>
                <p>Tìm kiếm sản phẩm theo từng danh mục chuyên biệt</p>
            </div>
            
            <div class="categories-grid">
                <a href="#" class="category-card">
                    <i class="fas fa-heart"></i>
                    <h3>Tim Mạch</h3>
                    <p>120+ sản phẩm</p>
                </a>
                
                <a href="#" class="category-card">
                    <i class="fas fa-stomach"></i>
                    <h3>Tiêu Hóa</h3>
                    <p>85+ sản phẩm</p>
                </a>
                
                <a href="#" class="category-card">
                    <i class="fas fa-brain"></i>
                    <h3>Thần Kinh</h3>
                    <p>95+ sản phẩm</p>
                </a>
                
                <a href="#" class="category-card">
                    <i class="fas fa-lungs"></i>
                    <h3>Hô Hấp</h3>
                    <p>110+ sản phẩm</p>
                </a>
                
                <a href="#" class="category-card">
                    <i class="fas fa-bone"></i>
                    <h3>Cơ Xương Khớp</h3>
                    <p>75+ sản phẩm</p>
                </a>
                
                <a href="#" class="category-card">
                    <i class="fas fa-user-friends"></i>
                    <h3>Da Liễu</h3>
                    <p>65+ sản phẩm</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <!-- <section class="newsletter">
        <div class="container">
            <h2>Đăng Ký Nhận Tin</h2>
            <p>Nhận thông tin khuyến mãi và tips sức khỏe mỗi tuần</p>
            <div class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Nhập email của bạn...">
                <button class="newsletter-btn">Đăng Ký</button>
            </div>
        </div>
    </section> -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <!-- Team Members Section -->
            <div class="team-section">
                <div class="section-title" style="margin: 0 0 40px 0;">
                    <h2 style="color: #ecf0f1;">Thành Viên Nhóm</h2>
                    <p style="color: #bdc3c7;">Đội ngũ phát triển website VitaMeds</p>
                </div>
                
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-avatar">A</div>
                        <div class="member-name">Nguyễn Văn An</div>
                        <div class="member-role">Team Leader - Backend Developer</div>
                        <div class="member-id">MSSV: 21010001</div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-avatar">B</div>
                        <div class="member-name">Trần Thị Bình</div>
                        <div class="member-role">Frontend Developer - UI/UX</div>
                        <div class="member-id">MSSV: 21010002</div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-avatar">C</div>
                        <div class="member-name">Lê Minh Cường</div>
                        <div class="member-role">Database Administrator</div>
                        <div class="member-id">MSSV: 21010003</div>
                    </div>
                    
                    <div class="team-member">
                        <div class="member-avatar">D</div>
                        <div class="member-name">Phạm Thị Dung</div>
                        <div class="member-role">Quality Assurance - Tester</div>
                        <div class="member-id">MSSV: 21010004</div>
                    </div>
                </div>
            </div>

            <div class="footer-content">
                <div class="footer-section">
                    <h3>VitaMeds</h3>
                    <p>Đồ án môn học: Lập trình Web<br>
                    Trường: Đại học Giao thông vận tải</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Thông Tin Dự Án</h3>
                    <ul>
                        <li><a href="#">Mô tả dự án</a></li>
                        <li><a href="#">Tài liệu kỹ thuật</a></li>
                        <li><a href="#">Database Schema</a></li>
                        <li><a href="#">API Documentation</a></li>
                        <li><a href="#">Source Code</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Công Nghệ Sử Dụng</h3>
                    <ul>
                        <li>Frontend: HTML5, CSS3, JavaScript</li>
                        <li>Backend: PHP, MySQL</li>
                        <li>Framework: Bootstrap</li>
                        <li>Tools: VSCode, phpMyAdmin</li>
                        <li>Version Control: Git, GitHub</li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Liên Hệ Nhóm</h3>
                    <p><i class="fas fa-envelope"></i> vitameds.team@student.uit.edu.vn</p>
                    <p><i class="fas fa-phone"></i> (+84) 123-456-789</p>
                    <p><i class="fas fa-map-marker-alt"></i> Đại học Giao thông vận tải</p>
                </div>
            </div>
            
        </div>
    </footer>