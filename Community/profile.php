<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/profiel.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class="ri-book-3-line"></i> <span class="logo_name">SocialBook's</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#">
                    <i class="ri-community-line"></i>
                    <span class="link_name">Community</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Community</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="ri-bookmark-line"></i>
                    <span class="link_name">Saved Books</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Saved Books</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="ri-upload-line"></i>
                    <span class="link_name">Upload a Book</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Upload a Book</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="ri-user-line"></i>
                    <span class="link_name">User Information</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">User Information</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">Prem Shahi</div>
                        <div class="job">Web Designer</div>
                    </div>
                    <i class="ri-logout-box-r-line"></i>
                </div>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="tab-navigation">
            <button class="tab-link active" onclick="openTab(event, 'All')">All</button>
            <button class="tab-link" onclick="openTab(event, 'read')">To read</button>
            <button class="tab-link" onclick="openTab(event, 'Reading')">Reading</button>
        </div>
        <div id="All" class="tab-content" style="display: block;">
            <h2>All saved items</h2>
            <p>All Books</p>
        </div>
        <div id="read" class="tab-content">
            <h2>To read</h2>
            <p>To read books</p>
        </div>
        <div id="Reading" class="tab-content">
            <h2>Reading</h2>
            <p>Reading books</p>
        </div>
    </section>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-link");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".ri-menu-line");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>
</body>

</html>