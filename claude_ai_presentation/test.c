// C version - equivalent implementation
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

// Structure (equivalent to class)
typedef struct {
    char name[50];
    int age;
} Person;

// Constructor equivalent
Person* Person_create(const char* n, int a) {
    Person* p = (Person*)malloc(sizeof(Person));
    if (p != NULL) {
        strncpy(p->name, n, 49);
        p->name[49] = '\0';
        p->age = a;
    }
    return p;
}

// Destructor equivalent
void Person_destroy(Person* p) {
    if (p != NULL) {
        printf("Destroying Person: %s\n", p->name);
        free(p);
    }
}

// Member function equivalents
void Person_display(Person* p) {
    printf("Name: %s, Age: %d\n", p->name, p->age);
}

void Person_setAge(Person* p, int a) {
    p->age = a;
}

int Person_getAge(Person* p) {
    return p->age;
}

int main() {
    Person* p1 = Person_create("Alice", 30);
    Person_display(p1);
    Person_setAge(p1, 31);
    Person_display(p1);
    Person_destroy(p1);

    return 0;
}
