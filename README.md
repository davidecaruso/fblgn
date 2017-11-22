# fblgn

Facebook PHP SDK v5 login example.

## Usage

Create a config.ini file into the project root like the following:
```ini
[config]
app_id = [YOUR_APP_ID]
app_secret = [YOUR_APP_SECRET]
default_graph_version = v2.11

[options]
redirect_url = http://localhost:8080
request_path = adnetworkanalytics

scope[] = read_audience_network_insights
scope[] = read_insights

metrics[] = FB_AD_NETWORK_IMP
```
To test it run `php -S localhost:8080 -t public` and then click [here](http://localhost:8080).

## Author

[Davide Caruso][linkedin]

## License

Licensed under [MIT][mit].

[linkedin]: https://it.linkedin.com/in/davidecaruso93
[mit]: https://opensource.org/licenses/mit-license.php