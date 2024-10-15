const newPastEntryButton = document.querySelector('.js-new-past-entry');
const pastEntryContainer = document.querySelector('.js-past-entry-container');

newPastEntryButton.addEventListener('click', function(e) {
    pastEntryContainer.classList.toggle('hidden');
})