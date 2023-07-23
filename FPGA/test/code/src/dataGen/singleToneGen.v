/*
*                                        
* File  : singleToneGen.v
* Author: Duohua(Edward) Wang
* Init  : 09/27/2021
*/
`timescale 1ns/100ps

module singleToneGen
(
    input         I_clk   ,
    input         I_rst   ,
    input         I_rReady,
    output        O_dataEn,
    output [15:0] O_dataIm,
    output [15:0] O_dataRe 
);

localparam C_DATA_NUM = 32767;

reg        S_addrEn = 1'b0;
reg [15:0] S_addr   = 16'd0;
reg [ 3:0] S_state  = 4'd0;

always @ (posedge I_clk)
    begin
        if(I_rst || !I_rReady)
            begin
                S_addrEn <= 1'b0;
                S_addr   <= 16'd0;
                S_state  <= 4'd0;
            end
        else
            begin
                case(S_state)
                    4'd0:
                        begin
                            S_addrEn <= 1'b1;
                            S_addr   <= 16'd0;
                            S_state  <= 4'd1;
                       end
                    4'd1:
                        begin
                            if(C_DATA_NUM == S_addr + 1)
                                begin
                                    S_addrEn <= 1'b1;
                                    S_addr   <= 16'd0;
                                    S_state  <= 4'd1;
                                end
                            else
                                begin
                                    S_addrEn <= 1'b1;
                                    S_addr   <= S_addr + 16'd1;
                                    S_state  <= 4'd1;
                                end
                        end
                    default:
                        begin
                            S_addrEn <= 1'b0;
                            S_addr   <= 16'd0;
                            S_state  <= 4'd0;
                        end
                endcase
            end
    end

wire        T_brmDataEn;
wire [15:0] T_brmDataIm;
wire [15:0] T_brmDataRe;

blk_mem_gen_singleToneIm U_singleTuneIm_inst
(
    .clka  (I_clk      ),
    .addra (S_addr     ),
    .douta (T_brmDataIm)
);

blk_mem_gen_singleToneRe U_singleTuneRe_inst
(
    .clka  (I_clk      ),
    .addra (S_addr     ),
    .douta (T_brmDataRe)
);


comPulseShift #
(
    .C_SHIFT_NUM  (2          )
)
U_comPulseShift_inst
(
    .I_clk        (I_clk      ),
    .I_rst        (I_rst      ),
    .I_impulse    (S_addrEn   ),
    .O_pulseShift (T_brmDataEn)  
);

assign O_dataEn = T_brmDataEn;
assign O_dataIm = T_brmDataIm;
assign O_dataRe = T_brmDataRe;

endmodule
