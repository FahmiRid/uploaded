<!DOCTYPE html>
<html>

<head>
    <title>Upload New Materials</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            display: flex;
        }

        .sidebar {
            background-color: #333;
            color: #fff;
            width: 250px;
            height: 100vh;
            /* Adjusts the menu bar height to the full viewport height */
            padding: 20px;
        }

        .sidebar h2 {
            margin-top: 0;
            font-size: 20px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #fff;
            text-decoration: none;
        }

        .menu-item:hover {
            background-color: #555;
        }

        .menu-item i {
            margin-right: 10px;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .content h1 {
            margin-top: 0;
            font-size: 24px;
        }

        /* Additional Aesthetic Styles */

        .dashboard {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .menu-item i {
            font-size: 18px;
        }

        .content {
            background-color: #fff;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        /* Partition Styles */

        .menu-partition {
            height: 1px;
            background-color: #999;
            margin: 10px 0;
        }

        /* New Styles */

        .partitions {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .partition-box {
            flex-basis: 48%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
            text-decoration: none;
        }

        .partition-box:hover {
            transform: translateY(-5px);
        }

        .partition-box .partition-title {
            font-size: 20px;
            margin-top: 0;
            flex-grow: 1;
            color: black;
            /* Set text color to black */
        }

        .partition-box i {
            font-size: 24px;
            margin-right: 10px;
        }

        @media screen and (max-width: 768px) {
            .partitions {
                flex-direction: column;
            }

            .partition-box {
                flex-basis: 100%;
            }
        }

        /* Added style */
        .content p {
            margin-bottom: 100px;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <div class="sidebar">
            <h1>Hello World</h1>
            <h2>Teacher Dashboard</h2>
            <a class="menu-item" href="teacherdashboard.html">
                <i class="fas fa-home"></i> Home
            </a>
            <div class="menu-partition"></div>
            <a class="menu-item" href="#">
                <i class="fas fa-users"></i> Students
            </a>
            <div class="menu-partition"></div>
            <a class="menu-item" href="#">
                <i class="fas fa-calendar-alt"></i> Schedule
            </a>
            <div class="menu-partition"></div>
            <a class="menu-item" href="#">
                <i class="fas fa-book"></i> Grades
            </a>
            <div class="menu-partition"></div>
            <a class="menu-item" href="index.html">
                <i class="fas fa-cog"></i> Logout
            </a>
        </div>
        <div class="content">
            <h1>Upload New Materials</h1>

            <p>Click on the upload button to add a new material to your class.</p>
            <form action="pdf_upload.php" method="POST" enctype="multipart/form-data">
                <label for="myfile">Select a file:</label>
                <input type="file" name="pdfFile" id="pdfFileInput" accept=".pdf">
                <input type="submit" value="Submit">
            </form>
            <div id="pdfPreview"></div>
        </div>
        
        <script>
            const pdfFileInput = document.getElementById('pdfFileInput');
            const pdfPreview = document.getElementById('pdfPreview');

            pdfFileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                const fileReader = new FileReader();

                fileReader.onload = function (e) {
                    const pdfURL = e.target.result;
                    const embedTag = `<embed src="${pdfURL}" width="100%" height="600px" />`;
                    pdfPreview.innerHTML = embedTag;
                };

                fileReader.readAsDataURL(file);
            });
        </script>
    </div>
</body>

</html>