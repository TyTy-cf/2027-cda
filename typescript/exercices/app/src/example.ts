
export function exoZero(): string {
    return "Coucou on tente de faire du TS !";
}

export class Dice {

    private _value: number = 0;

    get value(): number {
        return this._value;
    }

    set value(value: number) {
        this._value = value;
    }

}