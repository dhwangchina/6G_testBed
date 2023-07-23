/*
* File  : comPulseShift.v
* Author: Duohua(Edward) Wang
* Init  : 09/26/2021
*/
`timescale 1ns/100ps

module comPulseShift #
(
    parameter C_SHIFT_NUM = 10
)
(
    input  I_clk       ,
    input  I_rst       ,
    input  I_impulse   ,
    output O_pulseShift 
);

reg [C_SHIFT_NUM+1:0] T_val = 0;

always @ (posedge I_clk)
    begin
        if(I_rst)
            begin
                T_val <= 0;
            end
        else
            begin
                if(1'b1 == I_impulse)
                    begin
						T_val <= {T_val[C_SHIFT_NUM:0],I_impulse};
                    end
                else
                    begin
                        T_val <= {T_val[C_SHIFT_NUM:0],1'b0};
                    end
            end
    end

assign O_pulseShift = T_val[C_SHIFT_NUM-1];

endmodule
