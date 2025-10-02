// C++ version with class
#include <iostream>
#include <cstring>

class Person {
private:
    char name[50];
    int age;

public:
    // Constructor
    Person(const char* n, int a) {
        strncpy(name, n, 49);
        name[49] = '\0';
        age = a;
    }

    // Destructor
    ~Person() {
        std::cout << "Destroying Person: " << name << std::endl;
    }

    // Member functions
    void display() {
        std::cout << "Name: " << name << ", Age: " << age << std::endl;
    }

    void setAge(int a) {
        age = a;
    }

    int getAge() {
        return age;
    }
};

int main() {
    Person p1("Alice", 30);
    p1.display();
    p1.setAge(31);
    p1.display();

    return 0;
}
