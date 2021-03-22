# Coding Challenge
Our editors have to manage tables which compare products or services (e.g. https://widget.vgl.org/?comparisonId=2907).
To manage these tables, the editors have to be able to create, update and delete products used in the tables.
Everytime a product is created, updated or deleted, different process have to be executed. For example if a product is updated, all tables using this product have to be updated.
Because these processes can take a long time and should not block the work of the editors, they must not be connected directly to the editors workflows but run independently.

You're asked to develop a software, which can handle this scenario in a simplified manner.

## Requirements:
- A product consist of an id, a name and a price
- Products must be able to be created, updated and deleted. A simple cli-script should be the entry point to these actions
- If a product was created/updated/deleted, an event must be written in a queue.
- The events should be read from the queue and processed.
- When processing the events, a message in these formats (depending on the event type) should be returned to the cli:
  - Product created: `Product created: {id} {name} {price}`
  - Product deleted: `Product deleted: {id}`
  - Product updated: `Product updated: {changed fields}`
- If there is time left at the end, please create one or more unit tests

*Note to the processing of events:*
In the message for product updates only fields which data actually changed should be returned. 
We assume, that an editor always only changes one field, never multiple at the same time.

## Implementation details

- Fork or pull this repository and create a pull request with your solution
- Use php 7.1 or higher
- The `src` directory should be used for the business logic
- The scripts in the `cli` directory are the entry points to the software
- To persist data use `App\Storage\Writer` (persists data in the `storage` directory)
- To read persisted data use `App\Storage\Reader`
- For unit tests create a `test` directory (`composer test` can be used to execute the tests)

## Goal
To check if your solution works like required, you can execute `php test_run.php` and `It works!` should be the cli response. 
Inspect the file `test_run.php` to see, how your software will be called.

It is not a problem if you cannot reach the goal in the given time or if you are not happy with the quality of your solution.
Please write comment/s in your pull request to tell us what you would have changed with more time or where you can see potential problems.
