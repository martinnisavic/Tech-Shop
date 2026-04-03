

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


export async function updateUserProfile(podaci) {
    try {
        const response = await fetch("funkcijePhp/editObrada.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams(podaci)
        });

        if (!response.ok) {
            throw new Error("Mrežna greška ili serverski problem.");
        }

        return await response.json(); // Vraća JSON koji šalje PHP
    } catch (error) {
        console.error("Greška pri slanju:", error);
        return { status: 500, message: "Došlo je do greške na klijentu." };
    }
}