import { KaamelottApi } from "./KaamelottApi.ts";
import { Iquote } from "./Iquote.ts";

window.addEventListener("load", () => {
	const button: HTMLButtonElement | null =
		document.querySelector("#quoteButton");
	const quoteContainer: HTMLDivElement | null =
		document.querySelector("#quoteContainer");

	if (button && quoteContainer) {
		const quoteElement: HTMLParagraphElement = document.createElement("p");
		const seasonElement: HTMLParagraphElement = document.createElement("p");

		button.addEventListener("click", async () => {
			quoteContainer.innerHTML = "";
			quoteElement.textContent = "";
			let quote: Iquote = await new KaamelottApi().getRandomQuote();

			quoteElement.textContent = quote.characts + ": " + quote.content;
			seasonElement.textContent +=
				" (" + quote.season + "E" + quote.episode + ")";
			quoteContainer!.appendChild(quoteElement);
			quoteContainer!.appendChild(seasonElement);
		});
	}
});
