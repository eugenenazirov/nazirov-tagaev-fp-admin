const checkInput = (e) => {
    const textInput = document.getElementById('textInput');
    if (textInput.value.trim() === '') {
        e.preventDefault();
        alert('Введите сообщение.');
    }
}

const scrollMessages= () => {
    let messages = document.getElementById('messages');
    messages.scrollTop = messages.scrollHeight;
}

const fmtDateTime = () => {
    let timeFields = document.querySelectorAll('.message-item__time');
    timeFields.forEach((timeField) => {
        timeField.innerText = setLocalDateTime(timeField);
    });
}

function setLocalDateTime(dateString) {
    let dateObj = new Date(`${dateString.innerText} UTC`);
    return dateObj.toLocaleString('kz-KZ', {
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
    });
}

function ready() {
    scrollMessages();
    fmtDateTime();

    const btn = document.getElementById('btn');
    btn.onclick = checkInput;
}

document.addEventListener("DOMContentLoaded", ready);
