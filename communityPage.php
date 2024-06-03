<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community - Book Sharing</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
            transition: background-color 0.3s, color 0.3s;
        }

        body.dark-mode {
            background-color: #333;
            color: #fff;
        }

        header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        header.dark-mode {
            background-color: #444;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }

        button#toggle-theme {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        section {
            width: 80%;
            margin-bottom: 40px;
        }

        #upload-book-form input,
        #upload-book-form textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }

        #upload-book-form button {
            width: 100%;
        }

        #community-books-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .book {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 10px;
            padding: 10px;
            width: calc(30% - 20px);
            box-sizing: border-box;
            text-align: center;
        }

        .book img {
            max-width: 100%;
            border-radius: 5px;
        }

        .dark-mode .book {
            border: 1px solid #555;
        }
    </style>
</head>

<body>
    <header>
        <h1>Community Book Sharing</h1>
        <button id="toggle-theme">Switch to Dark Mode</button>
    </header>

    <main>
        <section id="upload-book">
            <h2>Upload a Book</h2>
            <form id="upload-book-form">
                <input type="text" id="book-title" placeholder="Book Title" required>
                <input type="text" id="book-author" placeholder="Author" required>
                <input type="url" id="book-cover" placeholder="Cover Image URL" required>
                <textarea id="book-description" placeholder="Description" required></textarea>
                <button type="submit">Upload Book</button>
            </form>
        </section>

        <section id="community-books">
            <h2>Shared Books</h2>
            <div id="community-books-list">
                <!-- Shared books will be displayed here -->
            </div>
        </section>
    </main>

    <script src="scripts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('toggle-theme').addEventListener('click', toggleTheme);
            document.getElementById('upload-book-form').addEventListener('submit', uploadBook);
            fetchCommunityBooks();
        });

        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
            document.getElementById('toggle-theme').textContent =
                document.body.classList.contains('dark-mode') ? 'Switch to Light Mode' : 'Switch to Dark Mode';
        }

        function uploadBook(event) {
            event.preventDefault();
            const title = document.getElementById('book-title').value;
            const author = document.getElementById('book-author').value;
            const cover = document.getElementById('book-cover').value;
            const description = document.getElementById('book-description').value;

            // Send data to backend to save book (API endpoint to be replaced)
            fetch('https://your-api-url.com/upload-book', {
                    method: 'POST',
                    body: JSON.stringify({
                        title,
                        author,
                        cover,
                        description
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert('Book uploaded successfully!');
                    fetchCommunityBooks();
                })
                .catch(error => console.error('Error uploading book:', error));
        }

        function fetchCommunityBooks() {
            // Fetch shared books from backend (API endpoint to be replaced)
            fetch('https://your-api-url.com/community-books')
                .then(response => response.json())
                .then(books => displayCommunityBooks(books))
                .catch(error => console.error('Error fetching community books:', error));
        }

        function displayCommunityBooks(books) {
            const booksList = document.getElementById('community-books-list');
            booksList.innerHTML = '';

            books.forEach(book => {
                const bookElement = document.createElement('div');
                bookElement.classList.add('book');
                bookElement.innerHTML = `
            <img src="${book.cover}" alt="${book.title}">
            <h3>${book.title}</h3>
            <p>${book.author}</p>
            <p>${book.description}</p>
            <button onclick="likeBook(${book.id})">Like</button>
            <button onclick="addComment(${book.id})">Comment</button>
            <span id="likes-${book.id}">${book.likes} likes</span>
            <div id="comments-${book.id}">
                <!-- Comments will be loaded here -->
            </div>
        `;
                booksList.appendChild(bookElement);
            });
        }

        function likeBook(bookId) {
            fetch('like.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        book_id: bookId
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    fetchCommunityBooks();
                })
                .catch(error => console.error('Error liking book:', error));
        }

        function addComment(bookId) {
            const comment = prompt("Enter your comment:");
            if (comment) {
                fetch('comment.php', {
                        method: 'POST',
                        body: JSON.stringify({
                            book_id: bookId,
                            comment: comment
                        }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        fetchCommunityBooks();
                    })
                    .catch(error => console.error('Error adding comment:', error));
            }
        }
    </script>
</body>

</html>