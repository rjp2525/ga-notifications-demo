# Notification Demo Application

This is a demo application to show real-time notification functionality in a Laravel application with Reverb, Echo and the Laravel notification system.

https://github.com/user-attachments/assets/b4e750a6-2c56-4ea9-abf9-b54c41dcf080

## Prerequisites

- PHP 8.3
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- Composer
- NodeJS v20+ / NPM v10+

## Technology

- [Laravel 11](https://laravel.com/)
- [Breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze), for authentication scaffolding
- [Vue 3](https://vuejs.org/) (composition API), for frontend
- [InertiaJS](https://inertiajs.com/), for backend <> frontend communication protocol
- [Tailwind](https://tailwindcss.com/), for utility CSS framework
- [shadcn-vue](https://www.shadcn-vue.com/), for some pre-built UI components
- [momentjs](https://momentjs.com/), for client side parsing of dates
- [Reverb](https://laravel.com/docs/11.x/reverb) & [Echo](https://github.com/laravel/echo), for realtime websocket event and notification updates
- [Sail](https://laravel.com/docs/11.x/sail), for the Docker container (published + customized to run Reverb server)
- [Pest](https://pestphp.com/), for unit and feature tests (didn't have time to write a full featured test suite but it's there)
- [eslint](https://eslint.org/), [Prettier](https://prettier.io/), [Pint](https://laravel.com/docs/11.x/pint) for formatting
- [Typescript](https://www.typescriptlang.org/), for strict typed javascript
- Spatie's [laravel-markdown](https://github.com/spatie/laravel-markdown) package, for converting database markdown to safe HTML for rendering

## Installation & Setup

Start by cloning the repository and opening a terminal instance within the `ga-notifications-demo` folder:
```sh
git clone git@github.com:rjp2525/ga-notifications-demo
```

Install composer dependencies
```sh
composer install
```

Copy `.env.example` to `.env` and set the application key
```sh
php artisan key:generate
```

Set the required credentials for Reverb, these are 20-character strings with mixed case letters and numbers (no symbols)
```env
REVERB_APP_KEY=
REVERB_APP_SECRET=
```

Install dependencies and build frontend assets
```sh
npm i && npm run build
```

Start the Docker container (detached) with Sail:
```sh
./vendor/bin/sail up -d
```

Migrate and seed the database:
```sh
./vendor/bin/sail artisan migrate --seed
```

Run a queue listener to process notifications:
```sh
./vendor/bin/sail artisan queue:listen
```

## Testing Notifications

You should now be able to use the application.
- Open an incognito window and navigate to `localhost/login`
- Sign in with the credentials:
  ```
  patricia@example.com
  password
  ```
- Leave this window open on the dashboard page
- Open a ***non-incognito*** window and navigate to `localhost/login` again
- Sign in with an administrator account:
  ```
  admin@example.com
  password
  ```
- Once logged in, you should see a "New" link in the navigation menu to create a new announcement
- Create an anouncement:
  Title
  ```
  An example announcement
  ```
  Content (example from [Markdown Live Preview](https://markdownlivepreview.com/))
  ```markdown
  # Markdown syntax guide
  
  ## Headers
  
  # This is a Heading h1
  ## This is a Heading h2
  ###### This is a Heading h6
  
  ## Emphasis
  
  *This text will be italic*  
  _This will also be italic_
  
  **This text will be bold**  
  __This will also be bold__
  
  _You **can** combine them_
  
  ## Lists
  
  ### Unordered
  
  * Item 1
  * Item 2
  * Item 2a
  * Item 2b
  
  ### Ordered
  
  1. Item 1
  2. Item 2
  3. Item 3
      1. Item 3a
      2. Item 3b
  
  ## Images
  
  ![This is an alt text.](https://placehold.co/100 "This is a sample image.")
  
  ## Links
  
  You may be using [Markdown Live Preview](https://markdownlivepreview.com/).
  
  ## Blockquotes
  
  > Markdown is a lightweight markup language with plain-text-formatting syntax, created in 2004 by John Gruber with Aaron Swartz.
  >
  >> Markdown is often used to format readme files, for writing messages in online discussion forums, and to create rich text using a plain text editor.

  ## Inline code
  
  This web site is using `markedjs/marked`.
  ```
  ![image](https://github.com/user-attachments/assets/8cc9e9e0-95b4-474a-83f9-13cd92aee654)
- Once created, you should see the bell icon in the regular user account window as well as a stackable toast notification, along with the unread notifications section updated with the announcement just posted.
- You should be able to click "View" next to the notification, which will take you to the announcement page where the markdown is rendered properly
- Returning to the dashboard, you should now see the announcement you just clicked on shown in the "Past Announcements" section with a "Viewed" badge next to the title
- If you create 4 more announcements, you should see them appear in real-time on the user dashboard (Patricia) and once the 4th is added, it'll display pagination buttons to navigate
- Both paginated sections work independently from each other, so you can be on different pages for each but on the same view
