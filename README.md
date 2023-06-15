# rechamber
This social media plattform has his goal to prevent echo chamber and let people out of there social bubbles.

## how to run

```bash
docker compose up --build
```

wait until fully started

```bash
curl http://localhost:8080/rechamber/rechamber-api/api/v1/users
```

shows

```json
{"id":1,"username":"mega","email":"a@aol.com","password":"sec"}
```

which is the first entry from the database. (I would expect that you get all entries from the DB, but that's another story)