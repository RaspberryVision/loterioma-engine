# Loterioma Engine

## Dice

### Example request for dice game:

```
{
    "gameId": integer,
    "clientId": string,
    "userId": integer,
    "mode": integer,
    "parameters": {
        "bets": [
            {
                "number": integer,
                "amount": integer
            }
        ]
    }
}
```