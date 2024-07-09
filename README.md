# Restaurant Challenge API

The application runs on top of Laravel 9, PHP 8.2 and MySql 8.0.

### Running the API locally with Sail and Docker (macOS and Linux)

Make sure [Docker Desktop](https://www.docker.com/products/docker-desktop/) is installed and clone the project to your local machine. Once you have it, navigate to the project directory, run composer and start [Laravel Sail](https://laravel.com/docs/10.x/sail).

```
git clone git@bitbucket.org:crush37/foodics-challenge-{your-name}.git foodics-challenge-api

cd foodics-restaurant-api

cp .env.example .env

composer install

./vendor/bin/sail up
```

At this point you should have a running API and be able to start developing.

The first time the MySQL container starts, it will create two databases. One is called `laravel` and is there to support your local development. The other one is a dedicated testing database named `testing` and will ensure that your tests do not interfere with your development data.

Please refer to [Laravel Sail](https://laravel.com/docs/11.x/sail) documentation to learn more about how to interact with the application artisan commands, database, tests, etc. 

# The Challenge (part I)

Your team is developing a sophisticated restaurant management system to streamline operations for various food establishments. This system encompasses modules for order management:
* inventory tracking, customers, and financial transactions. As part of this system, the OrderService class was designed to handle the order placement and associated tasks such as order validation,
* calculation of order details, processing payments, notifying customers, sending invoices, and managing inventory, seamlessly.

Initially, we created the OrderService class to be responsible for doing the Job, but later it became a monolithic entity, making it difficult to maintain and scale as the system evolves.

* Your task is to analyze the provided OrderService class, identify the issues and challenges outlined above, and propose solutions to address each issue.
* You should refactor the code to adhere to SOLID principles.
* Please open one PR (or more) with the proposed solution.

# The Challenge (part II)

We need to report our daily revenue to an external service called Reporting Service and have the SendTotalRevenueReportJob scheduled to run daily for this purpose.
Creating a report requires interacting with the external API through a flow that depends on 3 different HTTP requests.

We have observed that one of these requests frequently fails randomly, causing the job to fail and be released back to the queue. When the job retries, all requests are triggered again, leading to some unexpected results and extra charges from the external service.
Another problem is sometimes we reach an hourly quota to submit reports (mostly because of the failures and retries). 

Another detail we observed is generating the report creates an unexpected high amount of db queries.

* The job does not re-trigger all requests upon retry and only retries from the failed request.
* The job should be resilient and handle retries efficiently, and it should also know when not to retry.
* Ensure the overall process is robust and efficient.
* Your task is to open a PR (or more) with a solution to achieve this outcome.

# The Challenge (part III)

In the open Pull Requests you'll find a PR from one of our new Junior engineers. Please read the description and review the PR. 

* Your task is to support the engineer and the team to achieve the best outcome from the PR.
* You should focus on code quality, the project standards, best practices and test coverage.
* Provide feedback that is supportive and aimed at helping the junior engineer improve.
* Use the opportunity to mentor the junior engineer. 
* Explain why certain changes are necessary and how they contribute to better code quality or performance.

# The Challenge (part IV)

And finally, we need to implement the create orders API. An interesting detail about it must have a limit/throttle on 
the amount of requests our API accepts per minute, AND per branch.

* Your task is to open a PR with a solution to achieve this outcome.
* You should focus on code quality, the project standards, best practices and test coverage.
* Your PR should be descriptive and provide enough information to support reviewers do their job and for future reference.
