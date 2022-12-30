API Documentation

Response Schema: JSON OBJECT {"success": Boolean, "message_code": String, "body": Array}

GET /api/items
- Fetches all items from the DB.
- Request arguments: none
- 404 - No item was found

GET /api/item
- Fetch item by selected from database
- Request arguments: {item_id:integer}
- 404 - No item was found

GET /api/selling
- Fetches all transactions from the DB.
- Request arguments: none
- 404 - No transaction was found

POST /api/selling/create
- Create transaction in the table transacaions in database
- Request arguments: {item_id:integer,quantity:integer,total:integer,user_id:integer}
- 410 - if quantity was not provided
- 411 - if item_id was not provided
- 412 - if total was not provided
- 413 - if transaction was not created


DELETE /api/selling/delete
Request arguments: {"id": integer,item_id: integer,quantity:integer}
- 410 - if id was not provided
- 411 - if item_id was not provided
- 412 - if quantity was not provided
- 404 - if item was not found