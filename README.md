# HTTP-framework

this is a barebone HTTP framework.
It provides an MVC model, but lets you choose how you implement most of the stuff.

# Controllers
controllers are situated in the `Src/Controller` folder. They should extend `\Smoq\Http\Controller\AbstractController`. 

# Dependency injection

While you have acces to the container statically everywhere, it is a better practice to use autowiring to inject parameters in your controllers.

# CLI

doctrine CLI : `php vendor/bin/doctrine-migration`
[doctrine migrations documentation](https://www.doctrine-project.org/projects/doctrine-migrations/en/3.7/reference/introduction.html#introduction)