# NiaPays - OctoberCMS Donation Plugin

This plugin allows you to quickly set up a donation form and integrate Stripe payments on your OctoberCMS website. 👍

## Features

- Clean, Bootstrap-styled donation form
- Stripe payments integration (just add your key)
- Drag-and-drop component for easy use

## Requirements

- OctoberCMS version 3.x or higher
- Stripe API keys (added in backend settings)

## Installation

1. Download or clone this repository into your `plugins` directory.
2. Run database migrations:
   ```bash
   php artisan october:migrate
   ```

## Usage

1. After installation, go to **NiaPays Settings** in the backend and add your Stripe keys.
2. Choose a redirect page for successful donations.

### Configuration

Make sure to include the following in your CMS page or layout to ensure the form works properly:
```
{% framework extras %}
```
If you experience issues, this is often the cause.

## Backend

The backend provides a simple table to view successful donations.

## Contributing

I’m still learning how to build plugins, so if you have any contributions, improvements, or just want to roast me ❤️, please create a pull request!

## License

MIT – free to use.

## Credits

ofthewildire / fuascailt / Kirsten
