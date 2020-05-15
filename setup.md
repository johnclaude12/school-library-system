### Install laravel
### create github repository

### How to install admin lte https://adminlte.io/docs/2.4/installation
```
npm install admin-lte@v3.0.0-alpha.2 --save
```

### The command to implement Auth is as follows:
```
composer require laravel/ui
php artisan ui vue --auth
```

### How to add bootstrap 4
```
composer require laravel/ui
php artisan ui bootstrap
npm install
```

### If your Login and Register page only shows plain HTML. And CSS is not loading properly then run this two command:
```
npm install
npm run dev
```

### Install Laravel Passport
```
composer require laravel/passport
php artisan migrate
php artisan vendor:publish --tag=passport-migrations
php artisan passport:install
php artisan vendor:publish --tag=passport-components
    *after running this command ^^ there's should be generate 3 vue component \resources\js\components\passport(folder)
```

### How to run project:
```
php artisan serve

npm run dev
```

### How to install fontawesome-free
```
npm install --save @fortawesome/fontawesome-free
```

### How to create Request?
```
php artisan make:request Request/UserRequest
```

### How to create Resource?
```
php artisan make:resource UserResource
```

### How to create Collection?
```
php artisan make:resource UserCollection
```

#### TIPS for Good Practice

```
// Add to classes if two properties return true
< div :class="{'red': isError, 'text-bold': isActive }” >< /div >
```

```
// Emitting
this.$emit('my-event') // instead of myEvent

// Listening
v-on:my-event
```

```
// We have this selector
export const language = (state) => state.userConfig.language;// In one of our actions, we need language:
// Bad
[GET_GAMES]({ commit, rootState }) {
   const lang = rootState.userConfig.language;
   // Do stuff...
}
// Good
[GET_GAMES]({ commit, rootState }) {
   const lang = language(rootState);
   // Do stuff...
}
```

