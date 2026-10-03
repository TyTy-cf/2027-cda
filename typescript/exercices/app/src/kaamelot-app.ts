import { KaamelottApi } from "./KaamelottApi.ts";
import { IKaamelottQuote } from "./interfaces/i-kaamelott-quote.ts";
import { ISound } from "./interfaces/i-sound.ts";

const kaamelottApi: KaamelottApi = new KaamelottApi();

function initQuote(): void {
    kaamelottApi.getRandomQuote()
        .then((quote: IKaamelottQuote) => {
            const container: HTMLDivElement|null = document.querySelector('div.container');
            if (!container) {
                return;
            }

            const card = document.createElement("div");
            card.classList.add("card", "mt-5");

            const title = document.createElement("h2");
            title.classList.add("card-header");
            title.textContent = "Citation de Kaamelott";

            const body = document.createElement("div");
            body.classList.add("card-body");
            body.textContent = quote.content;

            const footer = document.createElement("div");
            footer.classList.add("card-footer");
            footer.textContent =
                `Personnage : ${quote.characts ?? "Non renseigné"} · ` +
                `Acteur : ${quote.actor} · ` +
                `${quote.episode} (${quote.season})`;

            card.append(title, body, footer);
            container.appendChild(card);
        })
}

function initSound(): void {
    kaamelottApi.getRandomSound()
        .then((sound: ISound) => {
            const container: HTMLDivElement|null = document.querySelector('div.container');
            if (!container) {
                return;
            }
            const card = document.createElement("div");
            card.classList.add("card", "mt-4");

            const title = document.createElement("h2");
            title.classList.add("card-header");
            title.textContent = "Son aléatoire";

            const body = document.createElement("div");
            body.classList.add("card-body");

            const name = document.createElement("p");
            name.textContent = sound.name;

            const audio = document.createElement("audio");
            audio.src = sound.path;
            audio.controls = true;
            audio.classList.add("w-100");

            body.append(name, audio);
            card.append(title, body);
            container.appendChild(card);
        })
}

window.addEventListener("load", () => {
    initQuote();
    initSound();
});