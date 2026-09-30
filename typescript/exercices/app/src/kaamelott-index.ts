import {KaamelottApi} from "./api/kaamelott-api.ts";
import {IQuote} from "./interfaces/i-quote.ts";

const kaamelottApi: KaamelottApi = new KaamelottApi();

function initQuote(): void {
    kaamelottApi.getRandomQuote()
        .then((iQuote: IQuote) => {
            const container: HTMLDivElement|null = document.querySelector('div.container');
            if (!container) {
                return;
            }

            const card = document.createElement('div');
            card.classList.add('card');
            card.classList.add('mt-5');

            const cardBody = document.createElement('div');
            cardBody.innerText = iQuote.content;
            cardBody.classList.add('card-body');

            const cardFooter = document.createElement('div');
            cardFooter.innerText = 'Par ' + iQuote.characts + ' : ' + iQuote.episode + ' (' + iQuote.season + ')';
            cardFooter.classList.add('card-footer');

            card.appendChild(cardBody);
            card.appendChild(cardFooter);

            container.appendChild(card);
        });
}

window.addEventListener('load', () => {
    initQuote();
});