# Technical Interview Challenge 2

---

## 🚀 Quick Start

### Prerequisites

- [Docker & Docker Compose](https://docs.docker.com/compose/install/#scenario-one-install-docker-desktop)
- Make (`make` should be available on Linux/macOS or via Git Bash on Windows)

---

## 🛠️ Installation

Clone the repository and start the app:

```bash
git clone <your-repository-url>
cd interview-technical-challenge-2
make install
make migrate

| Command          | Description                                 |
| ---------------- | ------------------------------------------- |
| `make build`     | Build Docker containers                     |
| `make up`        | Start containers in the background          |
| `make down`      | Stop containers                             |
| `make restart`   | Restart containers                          |
| `make install`   | Start containers and run Composer install   |
| `make migrate`   | Run Laravel database migrations             |
| `make bash`      | Open a Bash shell in the app container      |
| `make ci-checks` | Run all CI checks (PHPStan, PHPCS, PHPUnit) |
| `make test-all`  | Run PHPUnit tests with coverage             |
| `make stan`      | Run PHPStan static analysis                 |
| `make sniff`     | Run PHPCS (PSR12 code style check)          |
| `make sniff-fix` | Auto-fix code style issues using PHPCBF     |

