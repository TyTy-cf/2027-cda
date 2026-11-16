
export class FetchRequest {

    public get<T>(url: string): Promise<T> {
        return fetch(url, {method: 'GET'})
            .then((response: Response): Promise<T> => {
                if (response.status === 200) {
                    return response.json();
                }
                throw new Error("Something went wrong");
            });
    }

    public post<T>(url: string, bodyContent: string): Promise<T> {
        return fetch(url, {method: 'POST', body: bodyContent})
            .then((response: Response) => {
                if (response.status === 200) {
                    return response.json();
                }
                throw new Error("Something went wrong");
            });
    }

}