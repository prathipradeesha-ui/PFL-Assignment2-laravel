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

function updateBookmarkCount() {
    const countElement = document.querySelector(
        "[data-bookmark-count]"
    );

    if (!countElement) {
        return;
    }

    countElement.textContent = getBookmarks().length;
}

function updateBookmarkView() {
    const viewButton = document.querySelector(
        "[data-bookmark-view]"
    );

    const postCards = document.querySelectorAll(
        "[data-post-card]"
    );

    const emptyMessage = document.querySelector(
        "[data-bookmark-empty]"
    );

    if (!viewButton || !postCards.length) {
        return;
    }

    const showingBookmarks =
        viewButton.getAttribute("data-bookmark-view") === "bookmarks";

    const bookmarks = getBookmarks();

    let visibleCount = 0;

    postCards.forEach((card) => {
        const postId = String(card.dataset.postId);

        const shouldShow =
            !showingBookmarks || bookmarks.includes(postId);

        card.classList.toggle("hidden", !shouldShow);

        if (shouldShow) {
            visibleCount += 1;
        }
    });

    if (emptyMessage) {
        emptyMessage.classList.toggle(
            "hidden",
            !showingBookmarks || visibleCount !== 0
        );
    }

    viewButton.textContent = showingBookmarks
        ? "← All Posts"
        : `★ Bookmarks (${bookmarks.length})`;
}

function setupBookmarkButtons() {
    const bookmarkButtons = document.querySelectorAll(
        "[data-bookmark-button]"
    );

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

            updateBookmarkCount();
            updateBookmarkView();
        });
    });
}

function setupBookmarkView() {
    const viewButton = document.querySelector(
        "[data-bookmark-view]"
    );

    if (!viewButton) {
        return;
    }

    viewButton.addEventListener("click", () => {
        const currentView =
            viewButton.getAttribute("data-bookmark-view");

        viewButton.setAttribute(
            "data-bookmark-view",
            currentView === "bookmarks"
                ? "all"
                : "bookmarks"
        );

        updateBookmarkView();
    });

    updateBookmarkView();
}

document.addEventListener("DOMContentLoaded", () => {
    setupBookmarkButtons();
    setupBookmarkView();
    updateBookmarkCount();
});
