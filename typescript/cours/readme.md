
# Typescript

### 1. Initialisation d'un projet vide

- Dans un dossier vide lancer la commande :

```sh
npm init -y
```

- Installer la dépendance Typescript, en dev !

```sh
npm install --save-dev typescript
```

- Initie la configuration Typescript (génère le tsonfig.json) :

```sh
npx tsc --init
```


On devrait avoir l'arborescence suivante :

```
dossier-ts/
├── dist/
├── package.json
└── tsconfig.json
```


- Afin d'avoir un Typescript **strict** volontairement, voici un `tsconfig.json` à utiliser :

```json
{
  "compilerOptions": {
    "target": "ES2022",
    "module": "NodeNext",
    "moduleResolution": "NodeNext",
    "rootDir": "./src",
    "outDir": "./dist",
    "strict": true,
    "sourceMap": true,
    "noEmitOnError": true
  },
  "include": ["src/**/*.ts"],
  "exclude": ["node_modules", "dist"]
}
```


- Déclarer que le projet utilise les modules ECMAScript :

```json
{
  "name": "example",
  "version": "1.0.0",
  "type": "module", // <-- ici !
  "scripts": {
    "build": "tsc",
    "start": "node dist/app.js",
    "dev": "tsc --watch"
  },
  "devDependencies": {
    "typescript": "^5.0.0"
  }
}
```

Via la ligne de script "dev" lorsque l'on lance la commande `npm run dev`, le compilateur "watch" nos sources `.ts` et les recompile directement.