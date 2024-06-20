
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> 
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
            overflow: hidden; /* Hide overflow to ensure no scrollbars */
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
            background-color: #FFA000;
            color: white;
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden; /* Ensure elements stay within the section */
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
            z-index: 1; /* Ensure text is above background elements */
        }

        .moving-element {
            position: absolute;
            width: 50px;
            height: 50px;
            background: white;
            opacity: 0.8;
            border-radius: 50%;
            pointer-events: none; /* Prevent elements from interfering with mouse events */
            transition: transform 0.1s ease-out;
            z-index: 0; /* Ensure elements are behind the text */
        }

        .element1 {
            top: 20%;
            left: 30%;
        }

        .element2 {
            top: 60%;
            left: 50%;
        }

        .element3 {
            top: 40%;
            left: 70%;
        }

        .element4 {
            top: 80%;
            left: 20%;
        }

        .element5 {
            top: 10%;
            left: 80%;
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

        .right-section label {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .right-section input[type="text"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .right-section h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .right-section .category {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .right-section .category label {
            flex: 1 1 calc(50% - 10px);
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            background-color: #f9f9f9;
            transition: box-shadow 0.3s ease;
            box-sizing: border-box;
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
            background-color: #FFC107;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .right-section button:hover {
            background-color: #FFA000;
        }

        /* Custom spacing for radio buttons */
        .right-section .form-check-input {
            margin-right: 10px;
        }
    </style>
   <div class="container">
    <div class="left-section">
        <div class="logo">Swanirbhar</div>
        <h1>Bring people together</h1>
        <div class="moving-element element1" data-speed="2"></div>
        <div class="moving-element element2" data-speed="4"></div>
        <div class="moving-element element3" data-speed="3"></div>
        <div class="moving-element element4" data-speed="2"></div>
        <div class="moving-element element5" data-speed="5"></div>
    </div>
    <div class="right-section">
        <form action="<?php echo e(route('store.community')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label for="community-name">What is the name of your community?</label>
            <input type="text" id="community-name" name="community_name" placeholder="e.g. Creators Club">
            <h2>Pick a community category</h2>
            <div class="category">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input community-radio" name="category" value="Finance">
                        <span>Finance</span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input community-radio" name="category" value="Personal & Career Development">
                        <span>Web Dev</span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input community-radio" name="category" value="Fitness">
                        <span>Fitness</span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input community-radio" name="category" value="Nutrition">
                        <span>Nutrition</span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input community-radio" name="category" value="Spirituality & Religion">
                        <span>Spirituality</span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input community-radio" name="category" value="Others">
                        <span>Others</span>
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create community</button>
        </form>
    </div>
</div>

    <script>
    document.addEventListener('mousemove', (e) => {
        const elements = document.querySelectorAll('.moving-element');
        elements.forEach(el => {
            const speed = el.getAttribute('data-speed');
            const x = (window.innerWidth - e.pageX * speed) / 100;
            const y = (window.innerHeight - e.pageY * speed) / 100;
            el.style.transform = `translateX(${x}px) translateY(${y}px)`;
        });
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const communityNameInput = document.getElementById('community-name');
            const communityRadios = document.querySelectorAll('.community-radio');
        
            communityRadios.forEach(radio => {
                radio.addEventListener('change', (e) => {
                    let selectedValue = e.target.value;
                    communityNameInput.value = selectedValue;
                });
            });
        
            communityNameInput.addEventListener('input', (e) => {
                let inputValues = e.target.value.split(',').map(val => val.trim());
                e.target.value = inputValues.filter(val => val).join(', ');
            });
        });
        </script>
        
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php /**PATH /home/u195145987/domains/swanirbhar.org.in/public_html/resources/views/web/default/pages/community_page.blade.php ENDPATH**/ ?>