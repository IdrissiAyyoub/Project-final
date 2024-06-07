

/*=============== LOGIN ===============*/
const loginButton = document.getElementById('login-button'),
    loginClose = document.getElementById('login-close'),
    loginContent = document.getElementById('login-content');

if (loginButton) {
    loginButton.addEventListener('click', () => {
        loginContent.classList.add('show-login')
    })
}

if (loginClose) {
    loginClose.addEventListener('click', () => {
        loginContent.classList.remove('show-login')
    })
}

/*=============== ADD SHADOW HEADER ===============*/
const shadowHeader = () => {
    const header = document.getElementById('header')

    this.scrollY >= 50 ? header.classList.add('shadow-header')
        : header.classList.remove('shadow-header')

}
window.addEventListener('scroll', shadowHeader)


/*=============== HOME SWIPER ===============*/
let swiperHome = new Swiper('.home__swiper', {
    loop: true,
    spaceBetween: -24, // Adjust this value as needed
    grabCursor: true,
    slidesPerView: 'auto',
    centeredSlides: 'auto',

    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },

    breakpoints: {
        1220: {
            spaceBetween: -32, // Adjust this value as needed
        }
    }
});




/*=============== FEATURED SWIPER ===============*/
let swiperFeatured = new Swiper('.featured__swiper', {
    loop: true,
    spaceBetween: 16, // Adjust this value as needed
    grabCursor: true,
    slidesPerView: 'auto',
    centeredSlides: 'auto',

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    breakpoints: {
        1150: {
            slidesPerView: 4,
            centeredSlides: false,
        }
    }
});


/*=============== NEW SWIPER ===============*/
let swiperPopular = new Swiper('.popular__swiper', {
    loop: true,
    spaceBetween: 16, // Adjust this value as needed
    slidesPerView: 'auto',




    breakpoints: {
        1150: {
            slidesPerView: 3,
        }
    }
});

/*=============== TESTIMONIAL SWIPER ===============*/

let swiperTestmonial = new Swiper('.testimonial__swiper', {
    loop: true,
    spaceBetween: 16, // Adjust this value as needed
    grabCursor: true,
    slidesPerView: 'auto',
    centeredSlides: 'auto',


    breakpoints: {
        1150: {
            slidesPerView: 3,
            centeredSlides: false,
        }
    }
});

/*=============== SHOW SCROLL UP ===============*/
const scrollUp = () => {
    const scrollUp = document.getElementById('scroll-up')

    this.scrollY >= 350 ? scrollUp.classList.add('show-scroll')
        : scrollUp.classList.remove('show-scroll')

}
window.addEventListener('scroll', scrollUp)
/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
const sections = document.querySelectorAll('section[id]')

const scrollActive = () => {
    const scrollDown = window.scrollY

    sections.forEach(current => {
        const sectionHeight = current.offsetHeight,
            sectionTop = current.offsetTop - 58,
            sectionId = current.getAttribute('id'),
            sectionsClass = document.querySelector('.nav__menu a[href*=' + sectionId + ']')

        if (scrollDown > sectionTop && scrollDown <= sectionTop + sectionHeight) {
            sectionsClass.classList.add('active-link')
        } else {
            sectionsClass.classList.remove('active-link')
        }
    })
}
window.addEventListener('scroll', scrollActive)

/*=============== DARK LIGHT THEME ===============*/
const themeButton = document.getElementById('theme-button');
const darkTheme = 'dark-theme';
const iconTheme = 'ri-sun-line';

// Retrieve the previously selected theme and icon from localStorage
const selectedTheme = localStorage.getItem('selected-theme');
const selectedIcon = localStorage.getItem('selected-icon');

// Function to get the current theme
const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light';
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'ri-moon-line' : 'ri-sun-line';

if (selectedTheme) {
    document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme);
    themeButton.classList[selectedIcon === 'ri-moon-line' ? 'add' : 'remove'](iconTheme);
}

// Add event listener to the theme button
themeButton.addEventListener('click', () => {
    // Toggle the dark theme and the icon class
    document.body.classList.toggle(darkTheme);
    themeButton.classList.toggle(iconTheme);

    // Save the current theme and icon to localStorage
    localStorage.setItem('selected-theme', getCurrentTheme());
    localStorage.setItem('selected-icon', getCurrentIcon());
});


const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 2500,
    delay: 400,

})

sr.reveal('.home__data, .featured__container, .new__container, .join__data, .testmonial__container, .footer')
sr.reveal('.home__images', { delay: 600 })
sr.reveal('.services__card', { interval: 100 })
sr.reveal('.search__card', { origin: 'left' })
sr.reveal('.search__images', { origin: 'right' })


// Fetch API
const API_ENDPOINT = "https://www.googleapis.com/books/v1/volumes?q=subject:fiction&orderBy=relevance&maxResults=40&key=AIzaSyBoRapgZn6sbfT03pNKLC-fCVyPeuzN7ew"; // Replace YOUR_API_KEY with your actual API key

fetch(API_ENDPOINT)
    .then(response => response.json())
    .then(data => {
        const booksContainer = document.querySelector('.featured__swiper .swiper-wrapper');
        const books = data.items;

        books.forEach(book => {
            const article = document.createElement('article');
            article.classList.add('featured__card');
            article.classList.add('swiper-slide');

            const img = document.createElement('img');
            img.src = book.volumeInfo.imageLinks.thumbnail || './Images/default.jpg'; // Default image path if thumbnail is not available
            img.alt = 'image';
            img.classList.add('featured__img');

            const title = document.createElement('h2');
            title.classList.add('featured__title');
            title.textContent = book.volumeInfo.title || 'Untitled'; // Default title if not available

            const authors = document.createElement('div');
            authors.classList.add('featured__prices');
            const authorsList = book.volumeInfo.authors ? book.volumeInfo.authors.join(', ') : 'Unknown Author'; // Default author if not available
            authors.innerHTML = `<span class="featured__discount">${authorsList}</span><br>`;

            const detailsButton = document.createElement('button');
            detailsButton.classList.add('button');
            detailsButton.textContent = 'Details';
            // Add event listener to navigate to details page
            detailsButton.addEventListener('click', () => {
                window.location.href = `detailsPage.php?id=${book.id}`;
            });

            const actionsDiv = document.createElement('div');
            actionsDiv.classList.add('featured__actions');
            const saveButton = document.createElement('button');
            saveButton.innerHTML = '<i class="ri-save-line"></i>';
            const shareButton = document.createElement('button');
            shareButton.innerHTML = '<i class="ri-share-forward-2-fill"></i>';
            actionsDiv.appendChild(saveButton);
            actionsDiv.appendChild(shareButton);

            article.appendChild(img);
            article.appendChild(title);
            article.appendChild(authors); // Replaced description with authors
            article.appendChild(detailsButton);
            article.appendChild(actionsDiv);

            booksContainer.appendChild(article);
        });
    })
    .catch(error => console.error('Error fetching data:', error));

document.addEventListener("DOMContentLoaded", () => {
    const API_KEY = "AIzaSyBoRapgZn6sbfT03pNKLC-fCVyPeuzN7ew";
    const API_ENDPOINT = `https://www.googleapis.com/books/v1/volumes?q=subject:fiction&orderBy=relevance&printType=books&key=${API_KEY}`;

    fetch(API_ENDPOINT)
        .then(response => response.json())
        .then(data => {
            // Filter out books without ratings
            const ratedBooks = data.items.filter(book => book.volumeInfo.averageRating);

            // Sort rated books by rating (highest to lowest)
            ratedBooks.sort((a, b) => b.volumeInfo.averageRating - a.volumeInfo.averageRating);

            // Get the container for popular books
            const popularBooksContainer = document.querySelector("#popular .popular__swiper .swiper-wrapper");

            // Clear any existing content in the container
            popularBooksContainer.innerHTML = "";

            // Populate the container with popular book cards
            ratedBooks.forEach(book => {
                const bookInfo = book.volumeInfo;

                // Create a new card for the book
                const card = document.createElement("a");
                card.href = bookInfo.previewLink; // Link to Google Books preview
                card.classList.add("popular__card", "swiper-slide");

                // Create the image element for the book cover
                const img = document.createElement("img");
                img.src = bookInfo.imageLinks.thumbnail;
                img.alt = "Book cover";
                img.classList.add("popular__img");

                // Create the content for the book card
                const content = document.createElement("div");
                content.innerHTML = `
                    <h2 class="popular__title">${bookInfo.title}</h2>
                    <div class="popular__prices">
                        <span class="popular__author">${bookInfo.authors ? bookInfo.authors.join(", ") : "Unknown Author"}</span>
                    </div>
                    <div class="popular__stars">
                        ${bookInfo.averageRating} <i class="ri-star-fill"></i>
                    </div>
                    <div>
                        <a href="./detailsPage.php?id=${book.id}" class="PopularButton">Details</a>
                    </div>
                `;

                // Append image and content to the card
                card.appendChild(img);
                card.appendChild(content);

                // Append the card to the container
                popularBooks.Container.appendChild(card);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});

document.addEventListener("DOMContentLoaded", () => {
    const API_KEY = "AIzaSyBoRapgZn6sbfT03pNKLC-fCVyPeuzN7ew";
    const searchForm = document.querySelector('.search');
    const searchInput = document.getElementById('search');
    const popularGrid = document.getElementById('popularGrid');

    searchForm.addEventListener('submit', event => {
        event.preventDefault();
        const query = searchInput.value.trim();
        console.log("Search query:", query); // Debugging
        if (query) {
            fetchBooks(query);
        }
    });

    function fetchBooks(query) {
        const API_ENDPOINT = `https://www.googleapis.com/books/v1/volumes?q=${query}&key=${API_KEY}`;
        console.log("API Endpoint:", API_ENDPOINT); // Debugging

        fetch(API_ENDPOINT)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log("API Response Data:", data); // Debugging
                if (!data.items) {
                    throw new Error('No items found in the response');
                }
                displayBooks(data.items);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function displayBooks(books) {
        popularGrid.innerHTML = ''; // Clear previous results

        books.forEach(book => {
            const bookInfo = book.volumeInfo;

            // Create a new card for the book
            const card = document.createElement("a");
            card.href = bookInfo.previewLink || "#"; // Link to Google Books preview or fallback to '#'
            card.classList.add("popular__card", "swiper-slide");
            card.target = "_blank"; // Open link in a new tab

            // Create the image element for the book cover
            const img = document.createElement("img");
            img.src = bookInfo.imageLinks?.thumbnail || 'default-thumbnail.jpg'; // Fallback image
            img.alt = `${bookInfo.title} cover`;
            img.classList.add("popular__img");

            // Create the content for the book card
            const content = document.createElement("div");
            content.classList.add("popular__content");
            content.innerHTML = `
                <h2 class="popular__title">${bookInfo.title}</h2>
                <div class="popular__author">${bookInfo.authors ? bookInfo.authors.join(", ") : "Unknown Author"}</div>
                <div class="popular__stars">${bookInfo.averageRating || 'No Rating'} <i class="ri-star-fill"></i></div>
                <a href="./detailsPage.php?id=${book.id}" class="PopularButton">Details</a>
            `;

            // Append image and content to the card
            card.appendChild(img);
            card.appendChild(content);

            // Append the card to the container
            popularGrid.appendChild(card);
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const API_KEY = "AIzaSyBoRapgZn6sbfT03pNKLC-fCVyPeuzN7ew";
    const urlParams = new URLSearchParams(window.location.search);
    const bookId = urlParams.get('id');

    if (bookId) {
        fetchBookDetails(bookId);
    }

    function fetchBookDetails(id) {
        const API_ENDPOINT = `https://www.googleapis.com/books/v1/volumes/${id}?key=${API_KEY}`;

        fetch(API_ENDPOINT)
            .then(response => response.json())
            .then(data => {
                console.log("Book Details:", data); // Debugging
                displayBookDetails(data);
            })
            .catch(error => console.error('Error fetching book details:', error));
    }

    function displayBookDetails(book) {
        const bookInfo = book.volumeInfo;

        document.getElementById('book-cover').src = bookInfo.imageLinks?.thumbnail || 'default-thumbnail.jpg';
        document.getElementById('book-title').textContent = bookInfo.title;
        document.getElementById('book-rating').textContent = `★ ${bookInfo.averageRating || 'No Rating'} • ${bookInfo.pageCount || 'N/A'} Pages • ${bookInfo.publishedDate || 'Unknown Date'} • ${bookInfo.language || 'N/A'}`;
        document.getElementById('book-genre').textContent = bookInfo.categories ? bookInfo.categories.join(", ") : "Unknown Genre";
        document.getElementById('book-description').textContent = bookInfo.description || "No description available.";
        document.getElementById('book-authors').textContent = bookInfo.authors ? bookInfo.authors.join(", ") : "Unknown Authors";
        document.getElementById('book-publisher').textContent = bookInfo.publisher || "Unknown Publisher";

        document.getElementById('preview-link').href = bookInfo.previewLink || "#";
        document.getElementById('info-link').href = bookInfo.infoLink || "#";
        document.getElementById('web-reader-link').href = bookInfo.canonicalVolumeLink || "#";
    }

});
