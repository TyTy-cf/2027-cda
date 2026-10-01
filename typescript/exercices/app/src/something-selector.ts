import { Fetch } from "./fetch.ts";

export class SomethingSelector<T> {
	public url: string;

	constructor(url: string) {
		this.url = url;
	}

	public getSomething(): Promise<T> {
		return new Fetch(this.url)
			.get<T[]>(this.url)
			.then((somethings: T[]) => {
				if (somethings.length === 0) {
					throw new Error("well that's bad");
				}

				return somethings[
					Math.floor(Math.random() * somethings.length)
				]!;
			});
	}

	public getAllOfSomething(): Promise<T[]> {
		return new Fetch(this.url)
			.get<T[]>(this.url)
			.then((somethings: T[]) => {
				if (somethings.length === 0) {
					throw new Error("well that's bad");
				}
				return somethings;
			});
	}
}
