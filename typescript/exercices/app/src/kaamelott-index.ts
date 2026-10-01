import {KaamelottApi} from "./api/kaamelott-api.ts";
import {IQuote} from "./interfaces/i-quote.ts";
import {ISound} from "./interfaces/i-sound.ts";

export class KaamelottIndex {

    private readonly _kaamelottApi: KaamelottApi|undefined;
    private readonly _element: HTMLElement|null;

    constructor(selector: string|HTMLElement) {
        if (selector instanceof HTMLElement) {
            this._element = selector;
        } else {
            this._element = document.querySelector(selector);
        }

        if (!this._element) return;

        this._kaamelottApi = new KaamelottApi();
    }

    public addRandomQuote(): void {
        if (!this._kaamelottApi) return;

        this._kaamelottApi.getRandomQuote()
            .then((iQuote: IQuote) => {
                this.addQuoteToContainer(iQuote);
            });
    }

    public addRandomSound(): void {
        if (!this._kaamelottApi) return;

        this._kaamelottApi.getRandomSound()
            .then((iSound: ISound) => {
                this.addSoundToContainer(iSound);
            });
    }

    public addMultipleRandomQuotes(qty: number = 10) {
        if (!this._kaamelottApi) return;

        this._kaamelottApi.getAllQuote()
            .then((iQuotes: IQuote[]) => {
                const tmpIndex: number[] = [];
                const max: number = iQuotes.length - 1;

                while (tmpIndex.length < qty) {
                    const random: number = Math.floor(Math.random() * max);
                    const tmpQuote: IQuote|undefined = iQuotes[random];

                    if (!tmpIndex.includes(random) && tmpQuote) {
                        tmpIndex.push(random);
                        this.addQuoteToContainer(tmpQuote);
                    }
                }
            });
    }

    private addQuoteToContainer(iQuote: IQuote): void {
        const card = document.createElement('div');
        card.classList.add('card');
        card.classList.add('mt-5');

        const cardBody = document.createElement('div');
        cardBody.innerText = iQuote.content;
        cardBody.classList.add('card-body');

        const cardFooter = document.createElement('div');

        let str: string = '';
        if (iQuote.characts && iQuote.characts !== 'null') {
            str = 'Par <strong>' + iQuote.characts + '</strong> - ';
        }

        if (iQuote.episode && iQuote.episode.trim().length > 0) {
            str += 'épisode ' + iQuote.episode;
        }
        str += ' (' + iQuote.season + ')';

        cardFooter.innerHTML = str;
        cardFooter.classList.add('card-footer');

        card.appendChild(cardBody);
        card.appendChild(cardFooter);

        if (this._element) {
            this._element.appendChild(card);
        }
    }

    private addSoundToContainer(iSound: ISound): void {
        const audio: HTMLAudioElement = document.createElement('audio');
        audio.src = iSound.path;
        audio.controls = true;

        const title: HTMLParagraphElement = document.createElement('p');
        title.innerText = iSound.name;
        title.classList.add('p-0');
        title.classList.add('m-0');
        title.classList.add('mt-5');

        if (this._element) {
            this._element.appendChild(title);
            this._element.appendChild(audio);
        }
    }

}

window.addEventListener('load', () => {
    const kaamelottIndex: KaamelottIndex = new KaamelottIndex('div.container');
    // kaamelottIndex.addRandomQuote();
    // kaamelottIndex.addRandomSound();
    kaamelottIndex.addMultipleRandomQuotes(5);
    document.title = 'Kaamelott Quotes';
});