<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GenStore - Test Payment Platform</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            flex-wrap: wrap;
        }

        .logo h1 {
            font-size: 28px;
        }

        .logo p {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .cart-icon {
            background: rgba(255,255,255,0.2);
            padding: 12px 25px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        /* Product Card */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
        }

        .product-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .product-description {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .product-price {
            font-size: 26px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 20px;
        }

        .product-price small {
            font-size: 14px;
            color: #999;
        }

        .add-to-cart {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .add-to-cart:hover {
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 30px;
            background: #2c3e50;
            color: white;
            margin-top: 50px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .logo h1 {
                font-size: 22px;
            }
            
            .products-grid {
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h1>🛍️ GenStore</h1>
            <p>Test Payment Integration Platform | Powered by GenStore</p>
        </div>
        <div class="cart-icon">
         <a href="{{url('view-cart-products')}}" style="color: white; text-decoration: none; display: flex; align-items: center; gap: 8px;">
        🛒 Shopping Cart (<span id="cartCount">0</span>)
    </a>
</div>
    </div>

    <div class="container">
        <div class="products-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=250&fit=crop?smartphone" alt="Smartphone">
                <div class="product-info">
                    <div class="product-title">Premium Smartphone</div>
                    <div class="product-description">Latest model with 128GB storage, 5G support, and amazing camera quality</div>
                    <div class="product-price">TZS 850,000 <small>TZS</small></div>
                    <button class="add-to-cart" onclick="addToCart('Smartphone',850000)" >Add to Cart</button>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=250&fit=crop?laptop" alt="Laptop">
                <div class="product-info">
                    <div class="product-title">Professional Laptop</div>
                    <div class="product-description">16GB RAM, 512GB SSD, perfect for work, gaming, and content creation</div>
                    <div class="product-price">TZS 1,250,000 <small>TZS</small></div>
                    <button class="add-to-cart" onclick="addToCart('Professional Laptop',1250000)" >Add to Cart</button>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=250&fit=crop?headphone" alt="Headphones">
                <div class="product-info">
                    <div class="product-title">Wireless Headphones</div>
                    <div class="product-description">Noise cancellation, 30 hours battery life, premium sound quality</div>
                    <div class="product-price">TZS 250,000 <small>TZS</small></div>
                    <button class="add-to-cart" onclick="addToCart('Wireless Headphones',250000)" >Add to Cart</button>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=250&fit=crop?watch" alt="Smart Watch">
                <div class="product-info">
                    <div class="product-title">Smart Watch Pro</div>
                    <div class="product-description">Track fitness, heart rate monitor, GPS, and sleep tracking</div>
                    <div class="product-price">TZS 350,000 <small>TZS</small></div>
                    <button class="add-to-cart" onclick="addToCart('Smart Watch Pro',350000)" >Add to Cart</button>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1486572788966-cfd3df1f5b42?w=400&h=250&fit=crop?game" alt="Gaming Console">
                <div class="product-info">
                    <div class="product-title">Gaming Console</div>
                    <div class="product-description">Next-gen gaming experience with 4K support and 1TB storage</div>
                    <div class="product-price">TZS 550,000 <small>TZS</small></div>
                    <button class="add-to-cart" onclick="addToCart('Gaming Console',550000)" >Add to Cart</button>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=400&h=250&fit=crop?camera" alt="Camera">
                <div class="product-info">
                    <div class="product-title">DSLR Camera</div>
                    <div class="product-description">Professional camera with 24MP sensor and 4K video recording</div>
                    <div class="product-price">TZS 950,000 <small>TZS</small></div>
                    <button class="add-to-cart" onclick="addToCart('DSLR Camera',950000)">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2026 GenStore - Test Payment Platform | For AzamPay Integration Testing</p>
        <p style="margin-top: 10px; font-size: 12px; opacity: 0.8;">📞 Support: +255 123 456 789 | ✉️ support@azamstore.co.tz</p>
    </div>
    
<script>
let cart = JSON.parse(localStorage.getItem("cart")) || [];

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function updateCartUI() {
    document.getElementById("cartCount").innerText = cart.length;
}

function addToCart(name, price,image) {

    console.log("clicked:", name, price,image);

    cart.push({
        name: name,
        price: price,
        image: image
    });

    localStorage.setItem("cart", JSON.stringify(cart));

    updateCartUI();

    alert(name + " added ✔");
}
</script>

</body>
</html>