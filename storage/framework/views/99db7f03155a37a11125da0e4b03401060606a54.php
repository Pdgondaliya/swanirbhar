
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
        overflow: hidden;
    }

    .container {
        display: flex;
        width: 80%;
        max-width: 1200px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        flex-direction: column;
    }

    @media (min-width: 992px) {
        .container {
            flex-direction: row;
        }
    }

    .left-section {
        background: linear-gradient(135deg, #FF512F, #FFA000);
        color: white;
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .left-section .logo {
        font-size: 24px;
        font-weight: bold;
        position: absolute;
        top: 20px;
        left: 20px;
    }

    .left-section h1 {
        font-size: 36px;
        margin-top: 20px;
        z-index: 1;
    }

    .futuristic-text {
        font-size: 24px;
        margin-top: 20px;
        position: relative;
        display: inline-block;
        overflow: hidden;
        white-space: nowrap;
        animation: typing 3s steps(30, end) infinite alternate;
        color: #ffffff;
        border-right: 2px solid white;
    }

    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }

    .right-section {
        background-color: white;
        padding: 40px;
        flex: 1;
    }

    .right-section form {
        display: flex;
        flex-direction: column;
    }

    .right-section h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .right-section .category {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .right-section .category label {
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: flex;
        align-items: center;
        cursor: pointer;
        background-color: #f9f9f9;
        transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .right-section .category label:hover {
        border-color: #FFA000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .right-section .category input[type="radio"] {
        margin-right: 10px;
    }

    .right-section button {
        padding: 15px;
        font-size: 16px;
        background-color: #6d3b6d;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
        color: white;
        transition: background-color 0.3s ease;
    }

    .right-section button:hover {
        background-color: #5b305b;
    }
</style>

<div class="container">
    <div class="left-section">
        <div class="logo">Swanirbhar</div>
        <h1>Bring people together</h1>
        <div class="futuristic-text" data-text="Education">Education</div>
    </div>
    <div class="right-section">
        <form action="<?php echo e(route('updateUserType')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h2>Who are you?</h2>
            <div class="category">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="category" value="1">
                        <span>📈 I'm a Teacher</span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="category" value="2">
                        <span>🚀 I'm a Content Creator</span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="category" value="3">
                        <span>💪 I'm a Student</span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="category" value="4">
                        <span>🌱 I run an Organization</span>
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create community</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="/2ndjs.js"></script>

<?php /**PATH /home/u195145987/domains/swanirbhar.org.in/public_html/resources/views/web/default/pages/additional_info.blade.php ENDPATH**/ ?>