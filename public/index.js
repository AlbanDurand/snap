function removeChildren(element) {
    while (element.childNodes.length > 0) {
        removeChildren(element.childNodes[0]);
        element.removeChild(element.childNodes[0]);
    }
}

document.querySelector('.js-configuration-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const requestData = {};

    for (let keyValue of formData.entries()) {
        requestData[keyValue[0]] = keyValue[1];
    }

    const request = new Request(
        form.getAttribute('action'),
        {
            method: 'POST',
            body: JSON.stringify(requestData)
        }
    );

    fetch(request)
        .then((response) => response.json())
        .then((data) => {
            const listContainer = document.querySelector('.js-results-logs');

            removeChildren(listContainer)

            for (let log of data) {
                const logElement = document.createElement('div');

                logElement.innerHTML = log;

                listContainer.appendChild(logElement);
            }

            const container = document.querySelector('.js-results');
            container.scrollTop = container.scrollHeight;
        })
});