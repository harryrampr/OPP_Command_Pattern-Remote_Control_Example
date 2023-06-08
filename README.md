## Command Pattern (OOP) - Remote Control Example

We are sharing some simple PHP code, showing the use of
the [Command Pattern](https://en.wikipedia.org/wiki/Command_pattern). You will see how modern versions of PHP,
supporting Classes, Interfaces and Enumerators, make it easy to implement the Command Pattern using this language.

### About It

The Command pattern is a behavioral design pattern in object-oriented programming that encapsulates a request as an
object, thereby allowing users to parameterize clients with different requests, queue or log requests, and support
undoable operations.

You can find the PHP 8.1 code
at [/app/src](https://github.com/harryrampr/OPP_Command_Pattern-Remote_Control_Example/tree/master/app/src, there is
testing at [/tests](https://github.com/harryrampr/OPP_Command_Pattern-Remote_Control_Example/tree/master/app/tests)
directory. HTML output with Tailwind CSS can be found
at [/app/public](https://github.com/harryrampr/OPP_Command_Pattern-Remote_Control_Example/tree/master/app/public)
directory.

### About the Pattern

The Command Pattern is one of the design patterns introduced by the "Gang of Four" (Erich Gamma, Richard Helm, Ralph
Johnson, and John Vlissides) in their influential
book ["Design Patterns: Elements of Reusable Object-Oriented Software"](https://en.wikipedia.org/wiki/Design_Patterns),
published in 1994. The book aimed to catalog and describe common design problems and their solutions in object-oriented
programming.

The Command Pattern draws inspiration from
the [Command-Query Separation](https://en.wikipedia.org/wiki/Command%E2%80%93query_separation) (CQS) principle,
advocated by Bertrand Meyer in
his book ["Object-Oriented Software Construction"](https://en.wikipedia.org/wiki/Object-Oriented_Software_Construction)
published in 1988. The CQS principle suggests that methods should be
separated into commands, which modify state, and queries, which return information without changing state. The Command
Pattern takes this idea further by encapsulating commands as objects, providing additional flexibility and
extensibility.

### Intent

The Command pattern aims to encapsulate a request as an object, allowing clients to parameterize operations, queue or
log requests, and support undoable actions. It promotes loose coupling between requesters and executors, enhancing
flexibility and reusability.

### Structure

- **Command:** Declares the common interface or abstract class for executing a command, typically including an execute()
  method.
- **ConcreteCommand:** Implements the Command interface, binding a specific action to a receiver and containing the
  necessary logic to execute the requested operation.
- **Receiver:** Performs the actual action associated with a command, defining the functionality required to execute the
  command.
- **Invoker:** Initiates the command and directs it to the appropriate receiver, holding a reference to the command
  object and triggering execution.
- **Client:** Creates concrete command objects, configures them with receivers, associates commands with invokers, and
  sets up the execution workflow.

### How it Works

1. The client creates concrete command objects and associates them with specific receivers.
2. The client configures invokers with the desired commands.
3. When a client wants to initiate an action, it calls the execute() method on the associated command.
4. The command object encapsulates the action and delegates it to the corresponding receiver.
5. The receiver performs the requested action.
6. The invoker triggers the command's execution by calling the execute() method.
7. The client can queue, log, or manipulate commands as needed.

### Benefits

- Decouples the requester from the executor, promoting loose coupling and flexibility.
- Enables parameterization of clients with different requests, enhancing customization.
- Supports queueing, logging, and audit trail of executed commands.
- Facilitates the implementation of undoable actions.
- Promotes reusability by encapsulating operations in separate command objects.
- Simplifies the addition of new commands without modifying existing code.
- Enhances extensibility by allowing dynamic configuration of commands.

### Applications

- **GUI Actions and Menu Systems:** The Command Pattern is frequently used in graphical user interfaces (GUIs) to handle
  user actions such as button clicks, menu selections, and keyboard shortcuts. Each action is encapsulated as a command
  object, which is executed when the corresponding user interaction occurs. This allows for decoupling user interface
  components from the actual operations they perform.
- **Undo/Redo Functionality:** The Command Pattern is well-suited for implementing undo and redo functionality in
  applications. Each command object represents an action or operation, and the Command Pattern allows for storing a
  history of executed commands. By keeping track of executed commands, it becomes possible to revert or redo previous
  actions with ease.
- **Transaction Management:** The Command Pattern can be used for transactional operations, where a sequence of
  operations needs to be executed as a single unit. Each individual operation is encapsulated as a command object, and a
  composite command can be created to execute multiple commands as a transaction. This allows for atomicity and
  consistency in executing complex operations.
- **Asynchronous and Queueing Systems:** The Command Pattern is useful in asynchronous programming scenarios or systems
  that involve task queueing. Commands can be queued and executed in a specific order, allowing for control over the
  sequence of operations. This pattern enables the decoupling of command execution from command invocation, making it
  easier to manage and schedule tasks.
- **Macro Recording and Playback:** The Command Pattern can be employed in systems that require macro recording and
  playback capabilities. Commands can be recorded as they are executed, and the recorded sequence of commands can be
  saved. Later, the recorded commands can be played back to recreate the same set of operations, enabling automation and
  repetitive task execution.
- **Remote Control Systems:** The Command Pattern is commonly used in remote control systems, such as home automation or
  multimedia control. Each button press on the remote control corresponds to a specific command object, which is
  executed to perform the desired action on the controlled devices. This pattern provides flexibility in configuring and
  extending the available commands.
- **Multi-level Menus and Wizards:** The Command Pattern is applicable in scenarios where multi-level menus or
  wizard-like interfaces are used. Each menu option or wizard step can be represented by a command object, allowing for
  dynamic construction and execution of the desired sequence of actions based on user input.

### Other Examples

In the context of a TV remote control, the Command pattern allows for efficient control of the television's functions.
Each button on the remote control is associated with a specific command, such as power, volume up, volume down, or
channel change. These commands are implemented as separate objects that encapsulate the corresponding actions. When a
button is pressed, the associated command object executes the desired action on the television. This approach decouples
the remote control from the television, allowing for flexible customization and easy addition of new commands. It also
facilitates features like command queuing and logging, enabling a seamless and user-friendly TV viewing experience.