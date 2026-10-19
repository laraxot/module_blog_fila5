# Nwidart Test Convention — Blog

- Tests: `laravel/Modules/Blog/tests/`.
- Fixtures owned by the module: `laravel/Modules/Blog/tests/Fixtures/`.
- Application, cross-module and theme tests may live under `laravel/tests/`, but
  they are not substitutes for Blog's module suite.
- Never create a second `laravel/tests/Modules/Blog/` tree.
