; 6809 Assembly Program
; Move data from register A to B and output to port

        ORG     $0100           ; Origin address

START:
        LDA     #$42            ; Load immediate value into A (example: $42)
        TFR     A,B             ; Transfer A to B
        STB     $FF00           ; Store B to output port at $FF00

        ; Alternative: Using register D (A:B pair)
        LDD     #$1234          ; Load D with $1234 (A=$12, B=$34)
        TFR     A,B             ; Transfer A to B
        STB     $FF00           ; Output B to port

        ; Using X register to B
        LDX     #$5678          ; Load X with $5678
        TFR     X,D             ; Transfer X to D (16-bit)
        TFR     A,B             ; Transfer A to B
        STB     $FF00           ; Output B to port

        SWI                     ; Software interrupt (halt)

        END     START
