

    export function changePicture(newIndex,imagesNumber,currentIndex,images) {

        images[currentIndex].classList.remove('show');
        images[currentIndex].classList.add('hide');

        currentIndex = (newIndex + imagesNumber) % imagesNumber;

        images[currentIndex].classList.remove('hide');
        images[currentIndex].classList.add('show');
        document.querySelector('.showing-index').textContent = currentIndex + 1;
        return currentIndex;
    }

     

export function PrikaziSakrij(id) {
    let div = document.querySelector("#" + id);
    if (div.classList.contains('hide')) {
        div.classList.remove('hide');
        div.classList.add('show');
    } else {
        div.classList.remove('show');
        div.classList.add('hide');
    }
}