document.addEventListener('DOMContentLoaded', function() {
    const messageCells = document.querySelectorAll('.message-cell');
    messageCells.forEach(cell => {
        cell.addEventListener('click', function() {
            if (this.style.whiteSpace === 'normal') {
                this.style.whiteSpace = 'nowrap';
                this.style.overflow = 'hidden';
                this.style.textOverflow = 'ellipsis';
            } else {
                this.style.whiteSpace = 'normal';
                this.style.overflow = 'visible';
                this.style.textOverflow = 'clip';
            }
        });
    });
});
    