## Project setup 

### Create .env file

Create .env based on the .env.dist and set all the values there.

### Start containers
```bash
docker-compose up -d --build
```

### Install dependencies
```bash
docker-compose exec php composer install
```

## Open your localhost http://127.0.0.1/
or run from console
```bash
docker exec -it supermetrics_api_php bash
php ./public/index.php
```

Statistics json example
```
[{"Average character length of posts per month":{"September":591,"August":507,"July":307,"June":304,"May":330,"April":511,"March":492}},{"Average number of posts per user per month":{"user_6":8,"user_0":8,"user_4":7,"user_1":9,"user_18":10,"user_11":7,"user_5":8,"user_9":8,"user_2":8,"user_13":8,"user_14":7,"user_8":6,"user_3":6,"user_17":7,"user_10":10,"user_19":6,"user_12":7,"user_16":7,"user_15":8,"user_7":6}},{"Longest post by character length per month":{"September":763,"August":775,"July":776,"June":776,"May":747,"April":788,"March":742}},{"Total posts split by week number":{"40":9,"39":36,"38":38,"37":40,"36":39,"35":36,"34":38,"33":37,"32":38,"31":38,"30":38,"29":40,"28":36,"27":40,"26":37,"25":36,"24":38,"23":36,"22":36,"21":38,"20":37,"19":38,"18":38,"17":36,"16":35,"15":39,"14":37,"13":16}}]
```