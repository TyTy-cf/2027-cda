import { KaamelottApi } from "./KaamelottApi.ts";
import { Iquote } from "./Iquote.ts";
import { ISound } from "./ISound.ts";

window.addEventListener("load", async () => {
	const quoteContainer: HTMLDivElement | null =
		document.querySelector(".card-body");
	const quotesContainer: HTMLDivElement | null =
		document.querySelector(".quotes");
	const soundContainer: HTMLDivElement | null =
		document.querySelector(".sounds");
	const quoteBtn: HTMLButtonElement | null =
		document.querySelector("#getQuote");
	const soundBtn: HTMLButtonElement | null =
		document.querySelector("#getSound");

	if (quoteBtn && quoteContainer) {
		const quoteElement: HTMLParagraphElement = document.createElement("p");
		const seasonElement: HTMLParagraphElement = document.createElement("p");

		quoteBtn.addEventListener("click", async () => {
			quoteContainer.innerHTML = "";
			quoteElement.textContent = "";
			let quote: Iquote = await new KaamelottApi().getRandomQuote();
			console.log(quote.content);
			quoteElement.textContent = quote.characts + ": " + quote.content;
			seasonElement.textContent +=
				" (" + quote.season + "E" + quote.episode + ")";
			quoteContainer!.appendChild(quoteElement);
			quoteContainer!.appendChild(seasonElement);
		});
	}
	if (soundBtn && quoteContainer) {
		const soundElement: HTMLAudioElement = document.createElement("audio");
		soundElement.controls = true;

		soundBtn.addEventListener("click", async () => {
			quoteContainer.innerHTML = "";
			let sound: ISound = await new KaamelottApi().getRandomSound();
			console.log(sound.path);
			soundElement.src = sound.path;
			quoteContainer!.appendChild(soundElement);
		});
	}

	if (quotesContainer) {
		let quotes: Array<Iquote> = await new KaamelottApi().getAllQuotes();
		if (quotes.length === 0) {
			quotesContainer.innerHTML = "well that's too bad";
			return;
		}

		for (let i = 0; i < quotes.length; i++) {
			const quote = quotes[i];
			if (quote === undefined) {
				continue;
			}
			const quoteId = quote.id.toString();
			const quoteContent = quote.content.toString();
			localStorage.setItem(quoteId, quoteContent);
		}

		const storedQuotes: Array<string> = Object.values(localStorage);
		const randomQuotes: Array<string> = [];

		for (let i = 0; i < 10; i++) {
			const randomIndex: number = Math.floor(
				Math.random() * storedQuotes.length,
			);
			if (storedQuotes[randomIndex] === undefined) {
				continue;
			}
			randomQuotes.push(storedQuotes[randomIndex]);
		}

		for (const randomQuote of randomQuotes) {
			const quoteElement: HTMLParagraphElement =
				document.createElement("p");
			quoteElement.classList.add("p-2");
			quoteElement.textContent = randomQuote;
			quotesContainer.appendChild(quoteElement);
		}
	}

	if (soundContainer) {
		let sounds: Array<ISound> = await new KaamelottApi().getAllSounds();
		if (sounds.length === 0) {
			soundContainer.innerHTML = "well that's too bad";
			return;
		}

		for (let i = 0; i < sounds.length; i++) {
			const sound = sounds[i];
			if (sound === undefined) {
				continue;
			}
			const soundName = sound.name.toString();
			const soundPath = sound.path.toString();
			localStorage.setItem(soundName, soundPath);
		}

		const storedSounds: Array<string> = Object.values(localStorage);
		const randomSounds: Array<string> = [];

		for (let i = 0; i < 10; i++) {
			const randomIndex: number = Math.floor(
				Math.random() * storedSounds.length,
			);
			if (storedSounds[randomIndex] === undefined) {
				continue;
			}
			randomSounds.push(storedSounds[randomIndex]);
		}

		for (const randomSound of randomSounds) {
			const soundElement: HTMLAudioElement =
				document.createElement("audio");
			soundElement.controls = true;
			soundElement.src = randomSound;
			soundContainer.appendChild(soundElement);
		}
	}
});
