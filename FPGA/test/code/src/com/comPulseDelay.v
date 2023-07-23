/*
* File  : comPulseDelay.v
* Author: Duohua(Edward) Wang
* Init  : 09/26/2021
*/
`timescale 1ns/100ps

module comPulseDelay #
(
    parameter C_SHIFT_NUM = 10
)
(
    input  I_clk       ,
    input  I_rst       ,
    input  I_pulse     ,
    output O_pulseDelay 
);

reg [C_SHIFT_NUM-1:0] T_delayCnt    = 0;
reg                   T_pulse       = 1'b0;
reg                   T_pulse_valid = 1'b0;

always @ (posedge I_clk)
    begin
        if(I_rst)
            begin
                T_pulse_valid <= 1'b0;
            end
        else if(1'b1 == I_pulse)
            begin
                T_pulse_valid <= 1'b1;
            end
        else if((C_SHIFT_NUM == 1) && (1'b1 == T_pulse_valid))
            begin
                T_pulse_valid <= 1'b0;
            end
        else if(C_SHIFT_NUM == T_delayCnt + 1)
            begin
                T_pulse_valid <= 1'b0;
            end
    end

always @ (posedge I_clk)
    begin
        if(I_rst)
            begin
                T_pulse    <= 1'b0;
                T_delayCnt <= 0;
            end
        else if((1'b1 == I_pulse) && (C_SHIFT_NUM == 1))
			begin
                T_pulse    <= 1'b1;
                T_delayCnt <= 1;
			end
        else if((1'b1 == T_pulse_valid) && (C_SHIFT_NUM == T_delayCnt + 1))
			begin
                T_pulse    <= 1'b0;
                T_delayCnt <= 0;
			end
        else if((1'b1 == T_pulse_valid) && (C_SHIFT_NUM == T_delayCnt + 2))
            begin
                T_pulse    <= 1'b1;
                T_delayCnt <= T_delayCnt + 1;
            end
        else if (1'b1 == T_pulse_valid)
            begin
                T_pulse    <= 1'b0;
                T_delayCnt <= T_delayCnt + 1;
            end
        else
            begin
                T_pulse    <= 1'b0;
                T_delayCnt <= 0;
            end
    end

assign O_pulseDelay = T_pulse;

endmodule
