<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GenStore - Shopping Cart</title>
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

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            padding: 10px 20px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            transition: all 0.3s;
            display: inline-block;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Cart Table */
        .cart-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .cart-title {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-table th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #dee2e6;
        }

        .cart-table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-name {
            font-weight: bold;
            color: #333;
        }

        .quantity-input {
            width: 60px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .remove-btn {
            background: #ff4757;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .remove-btn:hover {
            opacity: 0.8;
        }

        .cart-total {
            margin-top: 20px;
            text-align: right;
            padding-top: 20px;
            border-top: 2px solid #dee2e6;
        }

        .cart-total h3 {
            font-size: 24px;
            color: #333;
        }

        .cart-total span {
            color: #667eea;
            font-size: 28px;
        }

        .checkout-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: opacity 0.3s;
        }

        .checkout-btn:hover {
            opacity: 0.9;
        }

        .empty-cart {
            text-align: center;
            padding: 60px;
            color: #999;
        }

        .empty-cart h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .section-title {
            font-size: 24px;
            margin: 40px 0 20px 0;
            color: #333;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
        }

        .product-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .product-price {
            font-size: 22px;
            font-weight: bold;
            color: #667eea;
            margin: 10px 0;
        }

        .add-btn {
            width: 100%;
            padding: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .add-btn:hover {
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
            
            .nav-links a {
                margin: 0 10px;
            }
            
            .cart-table {
                font-size: 14px;
            }
            
            .cart-table td, .cart-table th {
                padding: 10px;
            }
            
            .product-img {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h1>🛍️ AzamStore</h1>
            <p>Test Payment Integration Platform</p>
        </div>
        <div class="nav-links">
            <a href="#products">Products</a>
            <a href="#cart">My Cart</a>
        </div>
    </div>

    <div class="container">
        <!-- Cart Section -->
        <div id="cart" class="cart-container">
            <h2 class="cart-title">🛒 My Shopping Cart</h2>
            
            <!-- Sample Cart Items - You can edit these manually -->
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cartBody">
                    <!-- Cart Item 1 -->
                    
            </table>
            
            <div class="cart-total">
                <h3>Total: <span id="totalPrice">TZS 0</span></h3>

            <button class="checkout-btn" onclick="checkout()">
          💰         Proceed to Checkout
            </button>
            </div>
        </div>

        <!-- Products Section -->
        <h2 id="products" class="section-title">📦 Featured Products</h2>
        <div class="products-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300&h=200&fit=crop" alt="Smartphone">
                <div class="product-info">
                    <div class="product-title">Premium Smartphone</div>
                    <div class="product-price">TZS 850,000</div>
                    <button class="add-btn">+ Add to Cart</button>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=300&h=200&fit=crop" alt="Laptop">
                <div class="product-info">
                    <div class="product-title">Professional Laptop</div>
                    <div class="product-price">TZS 1,250,000</div>
                    <button class="add-btn">+ Add to Cart</button>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&h=200&fit=crop" alt="Headphones">
                <div class="product-info">
                    <div class="product-title">Wireless Headphones</div>
                    <div class="product-price">TZS 250,000</div>
                    <button class="add-btn">+ Add to Cart</button>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&h=200&fit=crop" alt="Smart Watch">
                <div class="product-info">
                    <div class="product-title">Smart Watch Pro</div>
                    <div class="product-price">TZS 350,000</div>
                    <button class="add-btn">+ Add to Cart</button>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1486572788966-cfd3df1f5b42?w=300&h=200&fit=crop" alt="Gaming Console">
                <div class="product-info">
                    <div class="product-title">Gaming Console</div>
                    <div class="product-price">TZS 550,000</div>
                    <button class="add-btn">+ Add to Cart</button>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card">
                <img class="product-image" src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=300&h=200&fit=crop" alt="Camera">
                <div class="product-info">
                    <div class="product-title">DSLR Camera</div>
                    <div class="product-price">TZS 950,000</div>
                    <button class="add-btn">+ Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 AzamStore - Test Payment Platform | Powered by AzamPay</p>
        <p style="margin-top: 10px; font-size: 12px;">📞 Support: +255 123 456 789 | ✉️ sales@azamstore.co.tz</p>
    </div>

<script>
let cart = JSON.parse(localStorage.getItem("cart")) || [];

let cartBody = document.getElementById("cartBody");
let total = 0;

// format price
function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// render cart
function renderCart() {

    cartBody.innerHTML = "";
    total = 0;

    if (cart.length === 0) {
        cartBody.innerHTML = `
            <tr>
                <td colspan="6" style="text-align:center;">
                    Cart is empty 🛒
                </td>
            </tr>
        `;
        return;
    }

    cart.forEach((item, index) => {

        cartBody.innerHTML += `
            <tr>
                <td>
                    <img class="product-img"
                    src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=250&fit=crop?watch">
                </td>
                <td class="product-name">${item.name}</td>
                <td>TZS ${formatPrice(item.price)}</td>
                <td>1</td>
                <td>TZS ${formatPrice(item.price)}</td>
                <td>
                    <button class="remove-btn" onclick="removeItem(${index})">
                        Remove
                    </button>
                </td>
            </tr>
        `;

        total += item.price;
    });

    document.querySelector(".cart-total span").innerText =
        "TZS " + formatPrice(total);
}

// remove item
function removeItem(index) {
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
}

// run
renderCart();
</script>

<script>
    
function checkout() {

    if (cart.length === 0) {
        alert("Cart is empty!");
        return;
    }

    let total = cart.reduce((sum, item) => sum + item.price, 0);

    fetch("api/checkout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name=csrf-token]').content
        },
        body: JSON.stringify({
            cart: cart,
            total: total
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);

        if (data.success || data.statusCode == 200) {
            alert("Payment sent ✔ Check phone");
        } else {
            alert("Payment failed ❌");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Server error ❌");
    });
}
</script>
</body>
</html>