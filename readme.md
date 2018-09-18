# Clean Architecture Sample
Implementation of Clean Architecture by Laravel.

Original blog post: [https://8thlight.com/blog/uncle-bob/2012/08/13/the-clean-architecture.html](https://8thlight.com/blog/uncle-bob/2012/08/13/the-clean-architecture.html)

![cleanarchitecture-8d1fe066e8f7fa9c7d8e84c1a6b0e2b74b2c670ff8052828f4a7e73fcbbc698c](https://user-images.githubusercontent.com/7877772/45727888-97f15e80-bc00-11e8-888a-24c190959a8d.jpg)

## Layers
### Entities
* Entities encapsulate Enterprise wide business rules.
* It doesn’t matter so long as the entities could be used by many different applications in the enterprise.

### Use Cases
* The software in this layer contains application specific business rules.
* These use cases orchestrate the flow of data to and from the entities, and direct those entities to use their enterprise wide business rules to achieve the goals of the use case.

### Interface Adapters
* The software in this layer is a set of adapters that convert data from the format most convenient for the use cases and entities.
* That will wholly contain the MVC architecture of a GUI.
  * The models are likely just data structures that are passed from the controllers to the use cases, and then back from the use cases to the presenters and views.

### Frameworks & Drivers
* The outermost layer is generally composed of frameworks and tools such as the Database, the Web Framework, etc.

## The Dependency Rule
* The overriding rule that makes this architecture work is The Dependency Rule. This rule says that source code dependencies can only point inwards.
  * Nothing in an inner circle can know anything at all about something in an outer circle.
  * The name of something declared in an outer circle must not be mentioned by the code in an inner circle.
* We usually resolve this apparent contradiction by using the Dependency Inversion Principle.
* Typically the data that crosses the boundaries is simple data structures.
  * You can use basic structs or simple Data Transfer objects if you like.
  * Or the data can simply be arguments in function calls.
