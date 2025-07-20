
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 fade-enter">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-heartbeat text-primary" style="font-size: 3rem;"></i>
                        <h3 class="mt-3 mb-4" style="color: var(--dark-color);">Login Posyandu</h3>
                    </div>
                    
                    <form method="post" action="cek_login.php" class="fade-enter">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="nama_admin" placeholder="Username" required>
                            <label for="username">
                                <i class="fas fa-user me-2"></i>Username
                            </label>
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-3 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
}

.form-floating > .form-control:focus,
.form-floating > .form-control:not(:placeholder-shown) {
    padding-top: 1.625rem;
    padding-bottom: .625rem;
}

.form-control {
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.15);
}

.btn-primary {
    border-radius: 10px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
}

/* Elegant animations */
@keyframes slideUp {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.fade-enter {
    animation: slideUp 0.5s ease-out forwards;
}
</style>
