var lastClickedCommand = null;

function showCommands(category) {
    var categories = document.getElementsByClassName('category');
    for (var i = 0; i < categories.length; i++) {
        categories[i].classList.remove('active');
    }

    var commands = document.getElementsByClassName('command');
    for (var j = 0; j < commands.length; j++) {
        commands[j].style.display = 'none';
    }

    var selectedCommands = document.getElementsByClassName(category);
    for (var k = 0; k < selectedCommands.length; k++) {
        selectedCommands[k].style.display = 'block';
    }

    var selectedCategory = document.querySelector('.category[data-category="' + category + '"]');
    selectedCategory.classList.add('active');

    if (lastClickedCommand && !lastClickedCommand.classList.contains(category)) {
        lastClickedCommand.classList.remove('active');
        lastClickedCommand = null;
    }
}

var commandItems = document.getElementsByClassName('command');
for (var l = 0; l < commandItems.length; l++) {
    commandItems[l].addEventListener('click', function() {
        if (lastClickedCommand && lastClickedCommand !== this) {
            lastClickedCommand.classList.remove('active');
        }
        this.classList.toggle('active');
        lastClickedCommand = this;
    });
}

// Standardmäßig die erste Kategorie anzeigen
showCommands('administration');