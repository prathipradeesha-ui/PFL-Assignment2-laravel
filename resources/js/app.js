const BOOKMARK_STORAGE_KEY = "projectHub-bookmarks";

function getBookmarks() {
    try {
        const stored = localStorage.getItem(BOOKMARK_STORAGE_KEY);

        if (!stored) {
            return [];
        }

        const parsed = JSON.parse(stored);

        return Array.isArray(parsed) ? parsed.map(String) : [];
    } catch (error) {
        console.error("Unable to load bookmarks:", error);
        return [];
    }
}

function saveBookmarks(bookmarks) {
    try {
        localStorage.setItem(
            BOOKMARK_STORAGE_KEY,
            JSON.stringify(bookmarks)
        );
    } catch (error) {
        console.error("Unable to save bookmarks:", error);
    }
}

function updateBookmarkButton(button, isBookmarked) {
    button.textContent = isBookmarked ? "★ Bookmarked" : "☆ Bookmark";
    button.setAttribute(
        "aria-pressed",
        isBookmarked ? "true" : "false"
    );

    button.classList.toggle("bg-yellow-100", isBookmarked);
    button.classList.toggle("text-yellow-800", isBookmarked);
    button.classList.toggle("border-yellow-300", isBookmarked);

    button.classList.toggle("bg-gray-100", !isBookmarked);
    button.classList.toggle("text-gray-700", !isBookmarked);
    button.classList.toggle("border-gray-300", !isBookmarked);
}

document.addEventListener("DOMContentLoaded", () => {
    const bookmarkButtons = document.querySelectorAll(
        "[data-bookmark-button]"
    );

    if (!bookmarkButtons.length) {
        return;
    }

    let bookmarks = getBookmarks();

    bookmarkButtons.forEach((button) => {
        const postId = String(button.dataset.postId);

        updateBookmarkButton(
            button,
            bookmarks.includes(postId)
        );

        button.addEventListener("click", () => {
            bookmarks = getBookmarks();

            if (bookmarks.includes(postId)) {
                bookmarks = bookmarks.filter(
                    (id) => id !== postId
                );
            } else {
                bookmarks.push(postId);
            }

            saveBookmarks(bookmarks);

            updateBookmarkButton(
                button,
                bookmarks.includes(postId)
            );
        });
    });
});
