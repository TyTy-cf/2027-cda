export class Fetch {
	private GET: string = "GET";
	protected url: string;

	constructor(url: string) {
		this.url = url;
	}

	public async get<T>(url: string): Promise<T> {
		return fetch(url, {
			method: this.GET,
			headers: {
				"content-type": "application/json",
			},
		}).then((response: Response) => {
			if (!response.ok) {
				throw new Error(`HTTP error! status: ${response.status}`);
			}
			return response.json() as Promise<T>;
		});
	}
}
