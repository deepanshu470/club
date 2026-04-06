// Form Validation for HostHub

document.addEventListener('DOMContentLoaded', function() {

    // Registration Form Validation
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            let isValid = true;
            const errors = [];

            // Get form fields
            const username = document.getElementById('username');
            const email = document.getElementById('email');
            const fullName = document.getElementById('full_name');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');

            // Clear previous errors
            clearErrors();

            // Validate username
            if (username.value.trim().length < 3) {
                isValid = false;
                errors.push('Username must be at least 3 characters long');
                showFieldError(username, 'Username must be at least 3 characters');
            } else if (!/^[a-zA-Z0-9_]+$/.test(username.value)) {
                isValid = false;
                errors.push('Username can only contain letters, numbers, and underscores');
                showFieldError(username, 'Only letters, numbers, and underscores allowed');
            }

            // Validate email
            if (!isValidEmail(email.value)) {
                isValid = false;
                errors.push('Please enter a valid email address');
                showFieldError(email, 'Invalid email address');
            }

            // Validate full name
            if (fullName.value.trim().length < 2) {
                isValid = false;
                errors.push('Please enter your full name');
                showFieldError(fullName, 'Full name is required');
            }

            // Validate password
            if (password.value.length < 6) {
                isValid = false;
                errors.push('Password must be at least 6 characters long');
                showFieldError(password, 'Password too short (minimum 6 characters)');
            }

            // Validate password confirmation
            if (password.value !== confirmPassword.value) {
                isValid = false;
                errors.push('Passwords do not match');
                showFieldError(confirmPassword, 'Passwords do not match');
            }

            if (!isValid) {
                e.preventDefault();
                showErrors(errors);
            }
        });
    }

    // Login Form Validation
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            const errors = [];

            const username = document.getElementById('username');
            const password = document.getElementById('password');

            clearErrors();

            if (username.value.trim() === '') {
                isValid = false;
                errors.push('Username or email is required');
                showFieldError(username, 'This field is required');
            }

            if (password.value === '') {
                isValid = false;
                errors.push('Password is required');
                showFieldError(password, 'This field is required');
            }

            if (!isValid) {
                e.preventDefault();
                showErrors(errors);
            }
        });
    }

    // Contact Form Validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            let isValid = true;
            const errors = [];

            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const subject = document.getElementById('subject');
            const message = document.getElementById('message');

            clearErrors();

            if (name.value.trim().length < 2) {
                isValid = false;
                errors.push('Please enter your name');
                showFieldError(name, 'Name is required');
            }

            if (!isValidEmail(email.value)) {
                isValid = false;
                errors.push('Please enter a valid email address');
                showFieldError(email, 'Invalid email address');
            }

            if (subject.value.trim().length < 5) {
                isValid = false;
                errors.push('Subject must be at least 5 characters');
                showFieldError(subject, 'Subject is too short');
            }

            if (message.value.trim().length < 10) {
                isValid = false;
                errors.push('Message must be at least 10 characters');
                showFieldError(message, 'Message is too short');
            }

            if (!isValid) {
                e.preventDefault();
                showErrors(errors);
            }
        });
    }

    // Real-time validation
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });

        input.addEventListener('input', function() {
            // Remove error state on input
            if (this.classList.contains('error')) {
                this.classList.remove('error');
                const errorMsg = this.parentElement.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            }
        });
    });

    // Password strength indicator
    const passwordInput = document.getElementById('password');
    if (passwordInput && registerForm) {
        const strengthIndicator = document.createElement('div');
        strengthIndicator.className = 'password-strength';
        strengthIndicator.innerHTML = '<div class="strength-bar"></div><span class="strength-text"></span>';
        passwordInput.parentElement.appendChild(strengthIndicator);

        passwordInput.addEventListener('input', function() {
            const strength = calculatePasswordStrength(this.value);
            updateStrengthIndicator(strengthIndicator, strength);
        });
    }
});

// Helper Functions

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validateField(field) {
    const value = field.value.trim();
    const type = field.type;
    const id = field.id;

    // Skip validation for optional fields
    if (!field.required && value === '') {
        return true;
    }

    let isValid = true;
    let errorMessage = '';

    switch(id) {
        case 'username':
            if (value.length < 3) {
                isValid = false;
                errorMessage = 'Username must be at least 3 characters';
            } else if (!/^[a-zA-Z0-9_]+$/.test(value)) {
                isValid = false;
                errorMessage = 'Only letters, numbers, and underscores allowed';
            }
            break;

        case 'email':
            if (!isValidEmail(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address';
            }
            break;

        case 'password':
            if (value.length < 6) {
                isValid = false;
                errorMessage = 'Password must be at least 6 characters';
            }
            break;

        case 'confirm_password':
            const password = document.getElementById('password');
            if (password && value !== password.value) {
                isValid = false;
                errorMessage = 'Passwords do not match';
            }
            break;

        default:
            if (field.required && value === '') {
                isValid = false;
                errorMessage = 'This field is required';
            }
    }

    if (!isValid) {
        showFieldError(field, errorMessage);
    }

    return isValid;
}

function showFieldError(field, message) {
    field.classList.add('error');

    // Remove existing error message
    const existingError = field.parentElement.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }

    // Add new error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    errorDiv.style.color = 'var(--error-color)';
    errorDiv.style.fontSize = '0.875rem';
    errorDiv.style.marginTop = '0.25rem';
    field.parentElement.appendChild(errorDiv);
}

function clearErrors() {
    const errorFields = document.querySelectorAll('.error');
    errorFields.forEach(field => field.classList.remove('error'));

    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(msg => msg.remove());
}

function showErrors(errors) {
    // You can display errors in a notification or alert
    if (errors.length > 0 && typeof showNotification === 'function') {
        showNotification(errors[0], 'error');
    }
}

function calculatePasswordStrength(password) {
    let strength = 0;

    if (password.length >= 6) strength += 20;
    if (password.length >= 10) strength += 20;
    if (/[a-z]/.test(password)) strength += 20;
    if (/[A-Z]/.test(password)) strength += 20;
    if (/[0-9]/.test(password)) strength += 10;
    if (/[^a-zA-Z0-9]/.test(password)) strength += 10;

    return Math.min(strength, 100);
}

function updateStrengthIndicator(indicator, strength) {
    const bar = indicator.querySelector('.strength-bar');
    const text = indicator.querySelector('.strength-text');

    bar.style.width = strength + '%';
    bar.style.height = '4px';
    bar.style.borderRadius = '2px';
    bar.style.transition = 'all 0.3s ease';
    bar.style.marginTop = '0.5rem';

    if (strength < 30) {
        bar.style.backgroundColor = '#ef4444';
        text.textContent = 'Weak';
        text.style.color = '#ef4444';
    } else if (strength < 60) {
        bar.style.backgroundColor = '#f59e0b';
        text.textContent = 'Fair';
        text.style.color = '#f59e0b';
    } else if (strength < 80) {
        bar.style.backgroundColor = '#3b82f6';
        text.textContent = 'Good';
        text.style.color = '#3b82f6';
    } else {
        bar.style.backgroundColor = '#10b981';
        text.textContent = 'Strong';
        text.style.color = '#10b981';
    }

    text.style.fontSize = '0.875rem';
    text.style.marginTop = '0.25rem';
    text.style.display = 'block';
}

// Add error styling
const style = document.createElement('style');
style.textContent = `
    input.error,
    textarea.error,
    select.error {
        border-color: var(--error-color) !important;
        background-color: #fee2e2;
    }

    .password-strength {
        margin-top: 0.5rem;
    }

    .strength-bar {
        background-color: #e5e7eb;
    }
`;
document.head.appendChild(style);
