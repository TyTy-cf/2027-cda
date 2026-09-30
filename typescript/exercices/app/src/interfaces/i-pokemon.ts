import {IStat} from "./i-stat.ts";

export interface IPokemon {
    id: number;
    name: string;
    weight: number;
    height: number;
    stats: Array<IStat>;
}